<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Domiciles_constituted extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mdomiciles_constituted');
		//Idioma
		$this->lang->load('domiciles_constituted', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "domiciles_constituted",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mdomiciles_constituted->_getDomicilesCons(),
			"novedades"  => $this->mdomiciles_constituted->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vdomiciles_constituted',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mdomiciles_constituted->_getFullData(
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

	public function newDomicileCons(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/domiciles_constituted?msg=emptyDescription');
			exit;
		}

		$resp = $this->mdomiciles_constituted->_newDomicileCons($data);

		if($resp){
			header('location:'.base_url().'parameters/domiciles_constituted?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/domiciles_constituted?msg=FailedInsert');
		}
	}

	public function updateDomicileCons(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description'])
		);
		$resp = $this->mdomiciles_constituted->_updateDomicileCons($data);
		if($resp){
			header('location:'.base_url().'parameters/domiciles_constituted?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/domiciles_constituted?msg=FailedUpdate');
			exit;
		}
	}

	public function delDomicileCons(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mdomiciles_constituted->_delDomicileCons($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}
}