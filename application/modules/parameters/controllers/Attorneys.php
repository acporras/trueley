<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Attorneys extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mattorneys');
		//Idioma
		$this->lang->load('attorneys', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "attorneys",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mattorneys->_getAttorneys(),
			"novedades"  => $this->mattorneys->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vattorneys',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mattorneys->_getFullData(
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

	public function newAttorney(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"auxiliar1"    => $this->security->xss_clean($this->input->post('auxiliar1')),
			"auxiliar2"    => $this->security->xss_clean($this->input->post('auxiliar2')),
			"auxiliar3"    => $this->security->xss_clean($this->input->post('auxiliar3')),
			"auxiliar4"    => $this->security->xss_clean($this->input->post('auxiliar4')),
			"auxiliar5"    => $this->security->xss_clean($this->input->post('auxiliar5'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/attorneys?msg=emptyDescription');
			exit;
		}

		$resp = $this->mattorneys->_newAttorney($data);

		if($resp){
			header('location:'.base_url().'parameters/attorneys?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/attorneys?msg=FailedInsert');
		}
	}

	public function updateAttorney(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'auxiliar1'    => $this->security->xss_clean($_POST['auxiliar1']),
			'auxiliar2'    => $this->security->xss_clean($_POST['auxiliar2']),
			'auxiliar3'    => $this->security->xss_clean($_POST['auxiliar3']),
			'auxiliar4'    => $this->security->xss_clean($_POST['auxiliar4']),
			'auxiliar5'    => $this->security->xss_clean($_POST['auxiliar5'])
		);
		$resp = $this->mattorneys->_updateAttorney($data);
		if($resp){
			header('location:'.base_url().'parameters/attorneys?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/attorneys?msg=FailedUpdate');
			exit;
		}
	}

	public function delAttorney(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mattorneys->_delAttorney($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}