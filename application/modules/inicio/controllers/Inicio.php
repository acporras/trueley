<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;
class Inicio extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('minicio');
		$this->_email = new Myemail();
		$this->load->library('recaptcha');
		//Idioma
	}
	
	public function index()
	{
		$data = [
			"url"       => base_url(),
			"titulo"    => $this->_conf['appname'],
			"clase"     => "base",
			"conf"      => $this->_conf,
			"planes"    => $this->minicio->_getPlanes(),
			"politicas" => $this->minicio->_getPoliticas()
		];


		$this->load->view('Vinicio',$data);

	}//

	public function contact(){

		$recaptcha = $this->input->post('captcha');
		if ($recaptcha=="") {
			echo "201";
			exit;
		}
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) and $response['success'] === false) {
			echo "201";
			exit;
		}

		$datos = array(
			'nombre'	=>	$this->security->xss_clean($_POST['nombre']),
			'email'	=>	$this->security->xss_clean($_POST['email']),
			'asunto'	=>	$this->security->xss_clean($_POST['asunto']),
			'mensaje'	=>	$this->security->xss_clean($_POST['mensaje']),
		);

		$d = "<ul>";
		$d .= "<li>Nombre: ".$datos['nombre']."</li>";
		$d .= "<li>Email: ".$datos['email']."</li>";
		$d .= "<li>Asunto: ".$datos['asunto']."</li>";
		$d .= "<li>Mensaje: ".$datos['mensaje']."</li>";
		$d .= "</ul>";
		$p = "Contacto Web por ".$datos['nombre'].", Email: ".$datos['email'].", Asunto: ".$datos['asunto'].", Mensaje: ".$datos['mensaje'];

		try{
			$email = $this->_email
					->from(['support@trueley.com','Equipo TrueLey','Contacto Web Trueley'])
                    ->to(['matias.estigarribia2112@gmail.com','Matias Estigarribia',$d,$p])
					->send();
			echo "200";
			exit;
			
		}catch(Exception $e){
			echo "fail";
			exit;
		}

	}//

	public function newAccount(){
		$data = [
			'nombre'    => $this->security->xss_clean($_POST['nombre']),
			'documento' => $this->security->xss_clean($_POST['documento']),
			'email'     => $this->security->xss_clean($_POST['email']),
			'direccion' => $this->security->xss_clean($_POST['direccion']),
			'telefonos' => $this->security->xss_clean($_POST['telefonos']),
			'codigo' => $this->security->xss_clean($_POST['codigo']),
		];

		if($data['nombre']=="" || $data['documento']== ""  || $data['email']== "" || $data['direccion']== "" || $data['telefonos']== ""){
			echo "202";//datos faltantes
			exit;
		}

		if(!valid_email($data['email'])){
			echo "201";//Email Errado
			exit;
		}

		$resp = $this->minicio->_newaccount($data);
		switch($resp){
			case '301':
				echo '204';
				exit;
			break;
			
			case '302':
				echo '205';
				exit;
			break;
			
			case '200':
				echo '200';
				exit;
			break;
			
			case '400':
				echo '400';
				exit;
			break;
		}

	}//

	public function activateaccount(){
		$cod = $this->security->xss_clean($_GET['codcliente']);
		$user = $this->security->xss_clean($_GET['user']);

		$this->db->set('estatus','1');
		$this->db->where('codcliente =',$cod);
		$this->db->update('clientes');
		
		$this->db->set('estatus','Active');
		$this->db->set('estado','1');
		$this->db->where('codcliente =',$cod);
		$this->db->where('usuario =',$user);
		$this->db->update('usuarios');

		header('location:'.base_url().'?msg=successReg');
		exit;

	}//


	public function restore(){
		$email = $this->security->xss_clean($_POST['email']);

		if($email==""){
			echo "nouser";
			exit;
		}

		if(!valid_email($email)){
			echo "badformat";
			exit;
		}

		$resp = $this->minicio->_restore($email);

		if($resp){
			echo "200";
			exit;
		}else{
			echo "nouser";
			exit;
		}
	}//

}
