<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Monetary_update extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mmonetary_update');
		//Idioma
		$this->lang->load('monetary_update', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "monetary_update",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mmonetary_update->_getMonetaryUpdate(),
			"novedades"  => $this->mmonetary_update->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vmonetary_update',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mmonetary_update->_getFullData(
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

	public function newMonetaryUpdate(){
		$data = array(
			"type"    => $this->security->xss_clean($this->input->post('type')),
			"date"    => $this->security->xss_clean($this->input->post('date')),
			"purchase"    => $this->security->xss_clean($this->input->post('purchase')),
			"sale"    => $this->security->xss_clean($this->input->post('sale'))
		);

		if($data['date']==""){
			header('location:'.base_url().'parameters/monetary_update?msg=emptyDate');
			exit;
		}

		if($data['purchase']==""){
			header('location:'.base_url().'parameters/monetary_update?msg=emptyPurchase');
			exit;
		}

		if($data['sale']==""){
			header('location:'.base_url().'parameters/monetary_update?msg=emptySale');
			exit;
		}

		$resp = $this->mmonetary_update->_newMonetaryUpdate($data);

		if($resp){
			header('location:'.base_url().'parameters/monetary_update?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/monetary_update?msg=FailedInsert');
		}
	}

	public function updateMonetaryUpdate(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'date'    => $this->security->xss_clean($_POST['date']),
			'purchase'    => $this->security->xss_clean($_POST['purchase']),
			'sale'    => $this->security->xss_clean($_POST['sale'])
		);
		$resp = $this->mmonetary_update->_updateMonetaryUpdate($data);
		if($resp){
			header('location:'.base_url().'parameters/monetary_update?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/monetary_update?msg=FailedUpdate');
			exit;
		}
	}

	public function delMonetaryUpdate(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mmonetary_update->_delMonetaryUpdate($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}