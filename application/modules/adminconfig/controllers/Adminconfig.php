<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use GuzzleHttp\Client;
class Adminconfig extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('madminconfig');
		//Idioma
		$this->lang->load('adminconfig', $this->_session->data->idioma);
		$this->uri = base_url();
	}
	
	public function index()
	{
		$data = [
			"url"      => base_url(),
			"titulo"   => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"    => "adminconfig",
			"conf"     => $this->_conf,
			"planes"   => $this->madminconfig->_getPlanes(),
			"con"      => $this->madminconfig->_getConfig(),
			"clientes" => $this->madminconfig->_getClients()
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vadminconfig',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function newPlan(){
		$data = array(
			'nombre'	=>	$this->security->xss_clean($_POST['nombre']),
			'limite'	=>	$this->security->xss_clean($_POST['limite']),
			'pesos'	=>	$this->security->xss_clean($_POST['pesos']),
			'boton'	=>	$_POST['boton'],
		);

		if($data['nombre']==""){
			header('location:'.base_url().'adminconfig?msg=emptydata');
			exit;
		}
		if($data['limite']=="" || $data['pesos']=="" || !is_numeric($data['limite']) || !is_numeric($data['pesos'])){
			header('location:'.base_url().'adminconfig?msg=errordata');
			exit;
		}

		$resp = $this->madminconfig->_newPlan($data);
		if($resp){
			header('location:'.base_url().'adminconfig?msg=success&tab=planes');
			exit;
		}else{
			header('location:'.base_url().'adminconfig?msg=fail&tab=planes');
			exit;
		}
	}//
	
	public function editplan(){
		$data = array(
			'nombre'  => $this->security->xss_clean($_POST['nombre']),
			'limite'  => $this->security->xss_clean($_POST['limite']),
			'pesos'   => $this->security->xss_clean($_POST['pesos']),
			'estatus' => $this->security->xss_clean($_POST['estatus']),
			'codigo'  => $this->security->xss_clean($_POST['codigo']),
			'boton'  => $_POST['boton'],
		);

		if($data['nombre']==""){
			header('location:'.base_url().'adminconfig?msg=emptydata');
			exit;
		}
		if($data['limite']=="" || $data['pesos']=="" || !is_numeric($data['limite']) || !is_numeric($data['pesos'])){
			header('location:'.base_url().'adminconfig?msg=errordata');
			exit;
		}

		$resp = $this->madminconfig->_editPlan($data);
		if($resp){
			header('location:'.base_url().'adminconfig?msg=success&tab=planes');
			exit;
		}else{
			header('location:'.base_url().'adminconfig?msg=fail&tab=planes');
			exit;
		}
	}//



	public function paypal(){
		$data = array(
			'estatus'	=>	$this->security->xss_clean($_POST['estatus']),
			'cuenta'	=>	$this->security->xss_clean($_POST['cuentapaypal']),
			'client'	=>	$this->security->xss_clean($_POST['paypalclient']),
			'secret'	=>	$this->security->xss_clean($_POST['paypalsecret']),
		);

		$resp = $this->madminconfig->_paypal($data);

		if($resp){
			header('location: '.base_url().'adminconfig?msg=successpaypal&tab=cuentas');
		}else{
			header('location: '.base_url().'adminconfig?msg=failpaypal&tab=cuentas');
		}

	}//
	
	public function mercadopago(){
		$data = array(
			'estatus'     => $this->security->xss_clean($_POST['estatus']),
			'id'     => $this->security->xss_clean($_POST['appidmp']),
			'secret' => $this->security->xss_clean($_POST['appsecretmp'])
		);

		$resp = $this->madminconfig->_mercadopago($data);

		if($resp){
			header('location: '.base_url().'adminconfig?msg=successmp&tab=cuentas');
		}else{
			header('location: '.base_url().'adminconfig?msg=failmp&tab=cuentas');
		}

	}//


	public function messages(){
		if(isset($_POST['nuevo'])){
			$resp = $this->madminconfig->_messages(
				array(
					$this->security->xss_clean($_POST['nuevo']),
					'nuevo'
				 )
			);
		}
		
		if(isset($_POST['clave'])){
			$resp = $this->madminconfig->_messages(
				array(
					$this->security->xss_clean($_POST['clave']),
					'clave'
				 )
			);
		}
		
		if(isset($_POST['politicas'])){
			$resp = $this->madminconfig->_messages(
				array(
					$this->security->xss_clean($_POST['politicas']),
					'politicas'
				 )
			);
		}

		if($resp){
			header("location:{$this->uri}adminconfig?msg=successMessage&tab=mensajes");
		}else{
			header("location:{$this->uri}adminconfig?msg=failMessage&tab=mensajes");
		}
	}//

	public function  novedad(){
		$novedad = ($this->_session->data->nivel=="Webmaster") ? $_POST['novedad'] : $this->security->xss_clean($_POST['novedad']);
		$data = array(
			'para'	=>	$this->security->xss_clean($_POST['para']),
			'novedad'	=>	$novedad
		);

		$resp = $this->madminconfig->_novedad($data);
		
		if($resp){
			header("location:{$this->uri}adminconfig?msg=successNovedad&tab=cuentas");
		}else{
			header("location:{$this->uri}adminconfig?msg=failNovedad&tab=cuentas");
		}
	}


	public function getBoton(){
		$plan = $this->security->xss_clean($_POST['plan']);
		$a = $this->db->query("SELECT * FROM planes WHERE codplan = '$plan'");
		$r = $a->row();
		echo $r->boton;
		exit;
	}


}//
