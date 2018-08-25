<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Intervention_characters extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mintervention_characters');
		//Idioma
		$this->lang->load('intervention_characters', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "intervention_characters",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mintervention_characters->_getInterventionCharacters(),
			"novedades"  => $this->mintervention_characters->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vintervention_characters',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mintervention_characters->_getFullData(
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

	public function newInterventionCharacter(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/intervention_characters?msg=emptyDescription');
			exit;
		}

		$resp = $this->mintervention_characters->_newInterventionCharacter($data);

		if($resp){
			header('location:'.base_url().'parameters/intervention_characters?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/intervention_characters?msg=FailedInsert');
		}
	}

	public function updateInterventionCharacter(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description'])
		);
		$resp = $this->mintervention_characters->_updateInterventionCharacter($data);
		if($resp){
			header('location:'.base_url().'parameters/intervention_characters?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/intervention_characters?msg=FailedUpdate');
			exit;
		}
	}

	public function delInterventionCharacter(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mintervention_characters->_delInterventionCharacter($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}