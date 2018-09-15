<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Holidays extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mholidays');
		//Idioma
		$this->lang->load('holidays', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "holidays",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mholidays->_getHolidays(),
			"novedades"  => $this->mholidays->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vholidays',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//
	public function getFullData(){
		$resp = $this->mholidays->_getFullData(
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

	public function newHoliday(){
		$data = array(
			"type"    => $this->security->xss_clean($this->input->post('type')),
			"date"    => $this->security->xss_clean($this->input->post('date')),
			"description"    => $this->security->xss_clean($this->input->post('description'))
		);

		if($data['date']==""){
			header('location:'.base_url().'parameters/holidays?msg=emptyDate');
			exit;
		}

		if($data['description']==""){
			header('location:'.base_url().'parameters/holidays?msg=emptyDescription');
			exit;
		}

		$resp = $this->mholidays->_newHoliday($data);

		if($resp){
			header('location:'.base_url().'parameters/holidays?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/holidays?msg=FailedInsert');
		}
	}

	public function updateHoliday(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'date'    => $this->security->xss_clean($_POST['date']),
			'description'    => $this->security->xss_clean($_POST['description'])
		);
		$resp = $this->mholidays->_updateHoliday($data);
		if($resp){
			header('location:'.base_url().'parameters/holidays?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/holidays?msg=FailedUpdate');
			exit;
		}
	}

	public function delHoliday(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mholidays->_delHoliday($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}
}