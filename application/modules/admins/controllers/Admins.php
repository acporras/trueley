<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Admins extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('madmins');
		//Idioma
		$this->lang->load('admins', $this->_session->data->idioma);
	}
	
	public function index()
	{
		$data = [
			"url"    => base_url(),
			"titulo" => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"  => "admins",
			"conf"   => $this->_conf,
			"lista"  => $this->madmins->_getLista()
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vadmins',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//


	public function newAdmin(){
		$data = array(
			"email"     => $this->security->xss_clean($this->input->post('email')),
			"nombre"    => $this->security->xss_clean($this->input->post('nombre')),
			"documento" => $this->security->xss_clean($this->input->post('documento')),
			"clave1"    => $this->security->xss_clean($this->input->post('clave11')),
			"clave2"    => $this->security->xss_clean($this->input->post('clave22')),
		);

		if($data['email']=="" || !valid_email($data['email']) ){
			header('location:'.base_url().'admins?msg=invalidEmail');
			exit;
		}
		if($data['nombre']==""){
			header('location:'.base_url().'admins?msg=emptyName');
			exit;
		}
		if($data['documento']==""){
			header('location:'.base_url().'admins?msg=emptuDocument');
			exit;
		}
		if($data['clave1']==""){
			header('location:'.base_url().'admins?msg=emptyKey');
			exit;
		}
		if($data['clave2']==""){
			header('location:'.base_url().'admins?msg=emptyKey');
			exit;
		}
		if($data['clave1'] !== $data['clave2']){
			header('location:'.base_url().'admins?msg=keysNotMatch');
			exit;
		}

		$resp = $this->madmins->_newAdmin($data);

		if($resp){
			header('location:'.base_url().'admins?msg=success');
		}else{
			header('location:'.base_url().'admins?msg=failed');
		}

	}//


	public function estatus(){
		$data = array(
			"tipo"	=>	$this->security->xss_clean($_POST['tipo']),
			"id"	=>	$this->security->xss_clean($_POST['id']),
			"clave"	=>	$this->security->xss_clean($_POST['clave']),
		);

		$resp = $this->madmins->_estatus($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//


	public function cambioclave(){
		$data = array(
			"anterior"	=>	$this->security->xss_clean($_POST['anterior']),
			"clave1"	=>	$this->security->xss_clean($_POST['clave1']),
			"clave2"	=>	$this->security->xss_clean($_POST['clave2'])
		);

		if($data['clave1']=="" || $data['clave2']==""  || $data['anterior']=="" ){
			header('location:'.base_url().'admins?msg=emptyKeys');
			exit;
		}
		if($data['clave1'] !== $data['clave2']){
			header('location:'.base_url().'admins?msg=keysNotMatch');
			exit;
		}

		$resp = $this->madmins->_cambioclave($data);
		echo ($resp) ? "200" : "201";
	}//

	public function edit(){
		$data = array(
			"usuario"   => $this->security->xss_clean($this->input->post('emailedit')),
			"nombre"    => $this->security->xss_clean($this->input->post('nombreedit')),
			"documento" => $this->security->xss_clean($this->input->post('documentoedit')),
			"id"        => $this->security->xss_clean($this->input->post('idedit')),
		);

		$resp = $this->madmins->_edit($data);
		if($resp){
			header('location:'.base_url().'admins?msg=successEdit');
			exit;
		}else{
			header('location:'.base_url().'admins?msg=failEdit');
			exit;
		}
	}//

	

}
