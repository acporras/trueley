<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Types_process extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mtypes_process');
		//Idioma
		$this->lang->load('types_process', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "types_process",
			"conf"        => $this->_conf,
			"lista"  => $this->mtypes_process->_getTypesProcess(),
			"novedades"  => $this->mtypes_process->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vtypes_process',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}
	public function newTypeProcess(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/types_process?msg=emptyDescription');
			exit;
		}

		$resp = $this->mtypes_process->_newTypeProcess($data);

		if($resp){
			header('location:'.base_url().'parameters/types_process?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/types_process?msg=FailedInsert');
		}
	}

	public function updateTypeProcess(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description'])
		);
		$resp = $this->mtypes_process->_updateTypeProcess($data);
		if($resp){
			header('location:'.base_url().'parameters/types_process?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/types_process?msg=FailedUpdate');
			exit;
		}
	}

	public function deltypeprocess(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mtypes_process->_deltypeprocess($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

	public function getFullData(){
		$resp = $this->mtypes_process->_getFullData(
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

}