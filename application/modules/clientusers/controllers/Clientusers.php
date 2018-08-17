<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class ClientUsers extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mclientusers');
		//Idioma
		$this->lang->load('clientusers', $this->_session->data->idioma);
	}
	
	public function index()
	{
		$data = [
			"url"    => base_url(),
			"titulo" => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"  => "clientusers",
			"conf"   => $this->_conf,
			"lista"  => $this->mclientusers->_getUsuarios(),
			"novedades"  => $this->mclientusers->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vclientusers',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function deleteUser(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mclientusers->_deleteUser($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//

	public function updateUser(){
		$val = $this->security->xss_clean($_POST['cambiouser']);

		if($val=="si"){
			$data = array(
				'nombre'    => $this->security->xss_clean($_POST['nombre']),
				'documento' => $this->security->xss_clean($_POST['documento']),
				'id'        => $this->security->xss_clean($_POST['id']),
				'codigo'    => $this->security->xss_clean($_POST['codigo']),
				'cambio'    => true,
				'email'    => $this->security->xss_clean($_POST['email']),
			);
			$resp = $this->mclientusers->_updateUser($data);
		}else{
			$data = array(
				'nombre'    => $this->security->xss_clean($_POST['nombre']),
				'documento' => $this->security->xss_clean($_POST['documento']),
				'id'        => $this->security->xss_clean($_POST['id']),
				'codigo'    => $this->security->xss_clean($_POST['codigo']),
				'cambio'    => false
			);
			$resp = $this->mclientusers->_updateUser($data);
		}

		if($resp){
			header('location:'.base_url().'clientusers?msg=successUpdate');
			exit;
		}else{
			header('location:'.base_url().'clientusers?msg=failUpdate');
			exit;
		}

	}//

	public function sendMail(){

		$resp = $this->mclientusers->_sendMail($this->security->xss_clean($_POST['id']));
		if($resp=="200"){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//

	public function test(){
		var_dump($this->uri->segment_array());
	}


	public function newUser(){
		$data = array(
			"email"     => $this->security->xss_clean($this->input->post('email')),
			"nombre"    => $this->security->xss_clean($this->input->post('nombre')),
			"documento" => $this->security->xss_clean($this->input->post('documento')),
			"clave1"    => $this->security->xss_clean($this->input->post('clave11')),
			"clave2"    => $this->security->xss_clean($this->input->post('clave22')),
		);

		if($data['email']=="" || !valid_email($data['email']) ){
			header('location:'.base_url().'clientusers?msg=invalidEmail');
			exit;
		}
		if($data['nombre']==""){
			header('location:'.base_url().'clientusers?msg=emptyName');
			exit;
		}
		if($data['documento']==""){
			header('location:'.base_url().'clientusers?msg=emptuDocument');
			exit;
		}
		if($data['clave1']==""){
			header('location:'.base_url().'clientusers?msg=emptyKey');
			exit;
		}
		if($data['clave2']==""){
			header('location:'.base_url().'clientusers?msg=emptyKey');
			exit;
		}
		if($data['clave1'] !== $data['clave2']){
			header('location:'.base_url().'clientusers?msg=keysNotMatch');
			exit;
		}

		$resp = $this->mclientusers->_newUser($data);

		if($resp){
			header('location:'.base_url().'clientusers?msg=success');
		}else{
			header('location:'.base_url().'clientusers?msg=failed');
		}

	}//

}
