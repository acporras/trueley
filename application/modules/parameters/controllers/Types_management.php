<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Types_management extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mtypes_management');
		//Idioma
		$this->lang->load('types_management', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "types_management",
			"conf"        => $this->_conf,
			"lista"       => $this->mtypes_management->_getTypesManagement(),
			"mae_fechacontrol" => $this->mtypes_management->_getFechaControl(),
			"novedades"  => $this->mtypes_management->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vtypes_management',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mtypes_management->_getFullData(
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

	public function newTypeManagement(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"cant_calculo"    => $this->security->xss_clean($this->input->post('cant_calculo')),
			"type_calculo"    => $this->security->xss_clean($this->input->post('type_calculo'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/types_management?msg=emptyDescription');
			exit;
		}

		if($data['cant_calculo']==""){
			header('location:'.base_url().'parameters/types_management?msg=emptyCantCalculo');
			exit;
		}

		$resp = $this->mtypes_management->_newTypeManagement($data);

		if($resp){
			header('location:'.base_url().'parameters/types_management?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/types_management?msg=FailedInsert');
		}
	}

	public function updateTypeManagement(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'cant_calculo'    => $this->security->xss_clean($_POST['cant_calculo']),
			'type_calculo'    => $this->security->xss_clean($_POST['type_calculo'])
		);
		$resp = $this->mtypes_management->_updateTypeManagement($data);
		if($resp){
			header('location:'.base_url().'parameters/types_management?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/types_management?msg=FailedUpdate');
			exit;
		}
	}

	public function delTypeManagement(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mtypes_management->_delTypeManagement($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}