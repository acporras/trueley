<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Types_states extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mtypes_states');
		//Idioma
		$this->lang->load('types_states', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "types_states",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mtypes_states->_getTypesStates(),
			"mae_movimientos" => $this->mtypes_states->_getMovimientos(),
			"novedades"  => $this->mtypes_states->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vtypes_states',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mtypes_states->_getFullData(
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

	public function newTypeState(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"movement"    => $this->security->xss_clean($this->input->post('movement'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/types_states?msg=emptyDescription');
			exit;
		}

		$resp = $this->mtypes_states->_newTypeState($data);

		if($resp){
			header('location:'.base_url().'parameters/types_states?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/types_states?msg=FailedInsert');
		}
	}

	public function updateTypeState(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'movement'    => $this->security->xss_clean($_POST['movement'])
		);
		$resp = $this->mtypes_states->_updateTypeState($data);
		if($resp){
			header('location:'.base_url().'parameters/types_states?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/types_states?msg=FailedUpdate');
			exit;
		}
	}

	public function delTypeState(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mtypes_states->_delTypeState($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}