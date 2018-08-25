<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Notifiers extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mnotifiers');
		//Idioma
		$this->lang->load('notifiers', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "notifiers",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mnotifiers->_getNotifiers(),
			"novedades"  => $this->mnotifiers->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vnotifiers',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mnotifiers->_getFullData(
			$this->security->xss_clean($_POST['id'])
		);
		if($resp){
			echo $resp;
			exit;
		}else{
			echo "201";
			exit;
		}
	}

	public function newNotifier(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"address"    => $this->security->xss_clean($this->input->post('address')),
			"city"    => $this->security->xss_clean($this->input->post('city')),
			"postalcode"    => $this->security->xss_clean($this->input->post('postalcode')),
			"phone"    => $this->security->xss_clean($this->input->post('phone')),
			"fax"    => $this->security->xss_clean($this->input->post('fax')),
			"email"    => $this->security->xss_clean($this->input->post('email')),
			"auxiliar1"    => $this->security->xss_clean($this->input->post('auxiliar1')),
			"auxiliar2"    => $this->security->xss_clean($this->input->post('auxiliar2')),
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/notifiers?msg=emptyDescription');
			exit;
		}

		if($data['phone']==""){
			header('location:'.base_url().'parameters/notifiers?msg=emptyPhone');
			exit;
		}

		$resp = $this->mnotifiers->_newNotifier($data);

		if($resp){
			header('location:'.base_url().'parameters/notifiers?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/notifiers?msg=FailedInsert');
		}
	}

	public function updateNotifier(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'address'    => $this->security->xss_clean($_POST['address']),
			'city'    => $this->security->xss_clean($_POST['city']),
			'postalcode'    => $this->security->xss_clean($_POST['postalcode']),
			'phone'    => $this->security->xss_clean($_POST['phone']),
			'fax'    => $this->security->xss_clean($_POST['fax']),
			'email'    => $this->security->xss_clean($_POST['email']),
			'auxiliar1'    => $this->security->xss_clean($_POST['auxiliar1']),
			'auxiliar2'    => $this->security->xss_clean($_POST['auxiliar2'])
		);
		$resp = $this->mnotifiers->_updateNotifier($data);
		if($resp){
			header('location:'.base_url().'parameters/notifiers?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/notifiers?msg=FailedUpdate');
			exit;
		}
	}

	public function delNotifier(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mnotifiers->_delNotifier($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}