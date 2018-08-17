<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;

//use Statickidz\GoogleTranslate;
class Notifications extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		//$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		//if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mbase');
		//Idioma
	}
	
	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "base",
			"conf"        => $this->_conf
		];

		$this->load->view('Vnotifications',$data);
	}//

	public function payments(){
		//MercadoPago\SDK::setAccessToken($this->_conf['prod_access_token']);
		//MercadoPago\SDK::setAccessToken($this->_conf['sand_access_token']);
		$mp = new MP($this->_conf['prod_access_token']);

		$json_event = file_get_contents('php://input', true);
		$event = json_decode($json_event);

		$filea = fopen(__DIR__.'/WEBHOOKRECEIVE-'.$this->general->date()->unix.".txt",'a');
		fwrite($filea, json_encode($json_event));
		fclose($filea);

		if (!isset($event->type, $event->data) || !ctype_digit($event->data->id)) {
			http_response_code(400);
			return;
		}
		
		if ($event->type == 'payment'){
			try{
				$payment_info = $mp->get('/v1/payments/'.$event->data->id);
				$filea = fopen(__DIR__.'/WEBHOOKPAYMENT-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($payment_info["response"]));
				fclose($filea);
			}catch(Exception $e){
				$filea = fopen(__DIR__.'/WEBHOOKPAYMENTNOTFOUND-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($e->getMessage()));
				fclose($filea);
			}
		}
		
		if ($event->type == 'subscription'){
			try{
				$payment_info = $mp->get('/v1/subscriptions/'.$event->data->id);
				$filea = fopen(__DIR__.'/WEBHOOKsubscriptions-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($payment_info["response"]));
				fclose($filea);
			}catch(Exception $e){
				$filea = fopen(__DIR__.'/WEBHOOKsubscriptionsNOTFOUND-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($e->getMessage()));
				fclose($filea);
			}
		}

		if ($event->type == 'test'){
			try{
				$payment_info = $mp->get('/v1/payments/'.$event->data->id);
				$filea = fopen(__DIR__.'/WEBHOOKTEST-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($payment_info["response"]));
				fclose($filea);
			}catch(Exception $e){
				$filea = fopen(__DIR__.'/WEBHOOKTESTNOTFOUND-'.$this->general->date()->unix.".txt",'a');
				fwrite($filea, json_encode($e->getMessage()));
				fclose($filea);
			}
		}


		/*switch($_POST["type"]) {
			case "payment":
				$payment = MercadoPago\Payment.find_by_id($_POST["id"]);
				break;
			case "plan":
				//$plan = MercadoPago\Plan.find_by_id($_POST["id"]);
				$payment = MercadoPago\Plan.find_by_id($_POST["id"]);
				break;
			case "subscription":
				//$plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
				$payment = MercadoPago\Subscription.find_by_id($_POST["id"]);
				break;
			case "invoice":
				//$plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
				$payment = MercadoPago\Invoice.find_by_id($_POST["id"]);
			break;
			
			case "test":
			//$plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
			$payment = $_GET;
			break;
		}
		$filea = fopen(__DIR__.'/WEBHOOKPOST-'.$this->general->date()->unix.".txt",'a');
		fwrite($filea, json_encode($_POST));
		fclose($filea);
		
		$filea = fopen(__DIR__.'/WEBHOOKGET-'.$this->general->date()->unix.".txt",'a');
		fwrite($filea, json_encode($_GET));
		fclose($filea);

		$file = fopen(__DIR__.'/WEBHOOK-'.$this->general->date()->unix.".txt",'a');
		fwrite($file, json_encode($payment));
		fclose($file);*/
		
	}//


	public function getPayments(){
		$mp = new MP($this->_conf['prod_client_id'], $this->_conf['prod_client_secret']);
		//$mp = new MP($this->_conf['sand_client_id'], $this->_conf['sand_client_secret']);

		if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
			http_response_code(400);
			return;
		}

		try{
			$payment_info = $mp->get_payment_info($_GET["id"]);
			
			if ($payment_info["status"] == 200) {
				/*$file = fopen(__DIR__.'/IPN-'.$this->general->date()->unix.'.txt','a');
				fwrite($file, json_encode($payment_info["response"]));
				fclose($file);*/

				//Validamos y actualziamos el Client id
				$valid = $this->updateClient($payment_info['response']);

				//Datos del cliente
				$dat = $this->clientData($payment_info['response']['collection']['payer']['id']);

				//Validamos el pago;
				$pag = $this->validPayment($payment_info['response']['collection']['id']);

				//Mes y año para registro de totales
				$year = date("Y",strtotime($payment_info['response']['collection']['date_created']));
				$mes = date("m",strtotime($payment_info['response']['collection']['date_created']));

				if($pag===true){
					//Si el pago es aprobado
					if($payment_info['response']['collection']['status'] == "approved"){
						$this->db->set('fechaupdate',$this->general->date()->datetime);
						$this->db->set('fechaapproval',$this->general->date()->datetime);
						$this->db->set('status',$payment_info['response']['collection']['status']);
						$this->db->set('status_detail',$payment_info['response']['collection']['status_detail']);
						$this->db->where('payment_id =',$payment_info['response']['collection']['id']);
						$this->db->update('pagosmp');

						//Si existe el Registro totales
						if($this->control([$year,$mes])){
							$this->db->set('monto','monto + '.$payment_info['response']['collection']['transaction_amount'],false);
							$this->db->set('receive','receive + '.$payment_info['response']['collection']['net_received_amount'],false);
							$this->db->where('ano =',$year);
							$this->db->where('mes =',$mes);
							$this->db->update('totales');
						}else{
							//Si no existe el registro en totales
							$tot = array(
								'ano'     => $year,
								'mes'     => $mes,
								'monto'   => $payment_info['response']['collection']['transaction_amount'],
								'receive' => $payment_info['response']['collection']['net_received_amount'],
								'pendin'  => '0'
							);
							$this->db->insert('totales',$tot);
						}

						//Registramos la novedad al Cliente
						$novedad = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	$dat['data']->codcliente,
							'tipo'	=>	'payment',
							'info'	=>	'Se ha <span class="label bg-success">Aprovado</span> el pago id: '.$payment_info['response']['collection']['id'].' de fecha '.date("d-m-Y",strtotime($payment_info['response']['collection']['date_created'])).' por concepto de Cobro Mensualidad del Servicio Trueley'
						);
						$this->db->insert('novedades',$novedad);
						
						//Registramos la novedad al administrador
						$novedadb = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	'Admin',
							'tipo'	=>	'payment',
							'info'	=>	'Se ha <span class="label bg-success">Aprovado</span> el pago id: '.$payment_info['response']['collection']['id'].' de fecha '.date("d-m-Y",strtotime($payment_info['response']['collection']['date_created'])).' por concepto de Cobro Mensualidad del Servicio Trueley a '.$dat['data']->nombrefirma
						);
						$this->db->insert('novedades',$novedadb);

					//Si el Pago quedo pendiente
					}else if($payment_info['response']['collection']['status'] == "in_process"){
						$this->db->set('fechaupdate',$this->general->date()->datetime);
						$this->db->set('fechaapproval',$this->general->date()->datetime);
						$this->db->set('status',$payment_info['response']['collection']['status']);
						$this->db->set('status_detail',$payment_info['response']['collection']['status_detail']);
						$this->db->where('payment_id =',$payment_info['response']['collection']['id']);
						$this->db->update('pagosmp');

						//Actualziación de totales
						if($this->control([$year,$mes])){
							$this->db->set('monto','monto + '.$payment_info['response']['collection']['transaction_amount'],false);
							$this->db->set('pendin','pendin + '.$payment_info['response']['collection']['net_received_amount'],false);
							$this->db->where('ano =',$year);
							$this->db->where('mes =',$mes);
							$this->db->update('totales');
						}else{
							$tot = array(
								'ano'     => $year,
								'mes'     => $mes,
								'monto'   => $payment_info['response']['collection']['transaction_amount'],
								'receive' => '0',
								'pendin'  => $payment_info['response']['collection']['net_received_amount']
							);
							$this->db->insert('totales',$tot);
						}

						$novedad = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	$dat['data']->codcliente,
							'tipo'	=>	'payment',
							'info'	=>	'Su pago id: '.$payment_info['response']['collection']['id'].' se encuentra en estatus: <span class="label bg-primary">Pendiente Cobro</span>, le notificaremos cuando su Estatus Cambie.'
						);
						$this->db->insert('novedades',$novedad);
						
						$novedadb = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	'Admin',
							'tipo'	=>	'payment',
							'info'	=>	'El Pago ID: '.$payment_info['response']['collection']['id'].' se encuentra en estatus: <span class="label bg-primary">Pendiente Cobro</span>, para el cliente '.$dat['data']->nombrefirma
						);
						$this->db->insert('novedades',$novedadb);

					//Si el pago Fué Cancelado
					}else if($payment_info['response']['collection']['status'] == "cancelled"){
						$this->db->set('fechaupdate',$this->general->date()->datetime);
						$this->db->set('fechaapproval',$this->general->date()->datetime);
						$this->db->set('status',$payment_info['response']['collection']['status']);
						$this->db->set('status_detail',$payment_info['response']['collection']['status_detail']);
						$this->db->where('payment_id =',$payment_info['response']['collection']['id']);
						$this->db->update('pagosmp');

						//Actualziación de totales
						if($this->control([$year,$mes])){
							$this->db->set('monto','monto - '.$payment_info['response']['collection']['transaction_amount'],false);
							$this->db->set('pendin','pendin - '.$payment_info['response']['collection']['net_received_amount'],false);
							$this->db->where('ano =',$year);
							$this->db->where('mes =',$mes);
							$this->db->update('totales');
						}

						$novedad = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	$dat['data']->codcliente,
							'tipo'	=>	'payment',
							'info'	=>	'Su pago id: '.$payment_info['response']['collection']['id'].' se encuentra en estatus: <span class="label bg-danger">Rechazado</span>, le invitamos nos contacte para informarle que pasos seguir para continuar disfrutando los servicios de Trueley.com.'
						);
						$this->db->insert('novedades',$novedad);
						
						$novedadb = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	'Admin',
							'tipo'	=>	'payment',
							'info'	=>	'El pago id: '.$payment_info['response']['collection']['id'].' del cliente '.$dat['data']->nombrefirma.' <span class="label bg-danger">Rechazado</span>, Por favor Contactar al cliente.'
						);
						$this->db->insert('novedades',$novedadb);
					}
				}else{
					//Si el pago no existe lo registramos
					if($dat['estatus']){
						$in = array(
							'codcliente'    => $dat['data']->codcliente,
							'payment_id'    => $payment_info['response']['collection']['id'],
							'fechareg'      => $this->general->date()->datetime,
							'fechaupdate'   => $this->general->date()->datetime,
							'fechaapproval' => $this->general->date()->datetime,
							'clientmpid'    => $payment_info['response']['collection']['payer']['id'],
							'clientname'    => $payment_info['response']['collection']['payer']['first_name'].' '.$payment_info['response']['collection']['payer']['last_name'],
							'clientphone'   => $payment_info['response']['collection']['payer']['phone']['number'],
							'clientdni'     => $payment_info['response']['collection']['payer']['identification']['type'].'-'.$payment_info['response']['collection']['payer']['identification']['number'],
							'clientemail'   => $payment_info['response']['collection']['payer']['email'],
							'nickname'      => $payment_info['response']['collection']['payer']['nickname'],
							'plan'          => $payment_info['response']['collection']['order_id'],
							'moneda'        => $payment_info['response']['collection']['currency_id'],
							'monto'         => $payment_info['response']['collection']['transaction_amount'],
							'receive'       => $payment_info['response']['collection']['net_received_amount'],
							'status'        => $payment_info['response']['collection']['status'],
							'status_detail' => $payment_info['response']['collection']['status_detail'],
							'payment_type'  => $payment_info['response']['collection']['payment_type'],
							'cardholder'    => json_encode($payment_info['response']['collection']['cardholder'])
						);
						$this->db->insert('pagosmp',$in);


						if($this->control([$year,$mes])){
							$this->db->set('monto','monto - '.$payment_info['response']['collection']['transaction_amount'],false);
							$this->db->set('pendin','pendin - '.$payment_info['response']['collection']['net_received_amount'],false);
							$this->db->where('ano =',$year);
							$this->db->where('mes =',$mes);
							$this->db->update('totales');
						}else{
							$tot = array(
								'ano'     => $year,
								'mes'     => $mes,
								'monto'   => $payment_info['response']['collection']['transaction_amount'],
								'receive' => $payment_info['response']['collection']['net_received_amount'],
								'pendin'  => '0'
							);
							$this->db->insert('totales',$tot);
						}
						
						$novedadb = array(
							'fecha'	=>	$this->general->date()->datetime,
							'para'	=>	'Admin',
							'tipo'	=>	'payment',
							'info'	=>	'El cliente: '.$payment_info['response']['collection']['payer']['first_name'].' '.$payment_info['response']['collection']['payer']['last_name'].' ha registrado un pago pendiente por cobrar ID:'.$payment_info['response']['collection']['id']
						);
						$this->db->insert('novedades',$novedadb);
					}
				}
			}//
			
			/*$file = fopen(__DIR__.'/IPNGET-'.$this->general->date()->unix.'.txt','a');
			fwrite($file, json_encode($_GET));
			fclose($file);*/

			//Reportamos el Status 200 a Mercadopago
			http_response_code(200);
			return;

		}catch(Exception $e){
			echo $e->getMessage();
			http_response_code(200);
			return;
		}

	}//

	private function updateClient($x){
		$this->db->select('*');
		$this->db->from('clientes');
		$this->db->where('emailfirma =',$x['collection']['payer']['email']);
		$q = $this->db->get();

		if($q->num_rows()>=1){
			$r = $q->row();

			if($r->idclientmp==""){
				$this->db->set('idclientmp',$x['collection']['payer']['id']);
				$this->db->where('codcliente =',$r->codcliente);
				$this->db->where('emailfirma =',$x['collection']['payer']['email']);
				$this->db->update('clientes');
				return true;
			}else{
				if($r->idclientmp = $x['collection']['payer']['id']){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}//

	private function clientData($x){
		$this->db->select('*');
		$this->db->from('clientes');
		$this->db->where('idclientmp =',$x);
		$q = $this->db->get();
		$ret = array();
		if($q->num_rows()>=1){
			$ret['estatus'] = true;
			$ret['data'] =	$q->row();
			return $ret;
		}else{
			$ret['estatus'] = false;
			$ret['msg'] = "El usuario no existe";
			return $ret;
		}
	}//

	private function validPayment($x){
		$this->db->select('*');
		$this->db->from('pagosmp');
		$this->db->where('payment_id =',$x);
		$q = $this->db->get();
		return ($q->num_rows()>=1) ? true : false;
	}//

	private function control($x){
		$this->db->select('*');
		$this->db->from('totales');
		$this->db->where('ano =',$x[0]);
		$this->db->where('mes =',$x[1]);
		$q = $this->db->get();
		return ($q->num_rows()===1) ? true : false;
	}//

}
