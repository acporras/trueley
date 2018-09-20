<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Indices_interest extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mindices_interest');
		//Idioma
		$this->lang->load('indices_interest', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "indices_interest",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mindices_interest->_getIndicesInterest(),
			"mae_variaciones" => $this->mindices_interest->_getVariaciones(),
			"novedades"  => $this->mindices_interest->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vindices_interest',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mindices_interest->_getFullData(
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

	public function newIndicesInterest(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"variation"   => $this->security->xss_clean($this->input->post('variation'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/indices_interest?msg=emptyDescription');
			exit;
		}

		$resp = $this->mindices_interest->_newIndicesInterest($data);

		if($resp){
			header('location:'.base_url().'parameters/indices_interest?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/indices_interest?msg=FailedInsert');
		}
	}

	public function updateIndicesInterest(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'variation'    => $this->security->xss_clean($_POST['variation'])
		);
		$resp = $this->mindices_interest->_updateIndicesInterest($data);
		if($resp){
			header('location:'.base_url().'parameters/indices_interest?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/indices_interest?msg=FailedUpdate');
			exit;
		}
	}

	public function delIndicesInterest(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mindices_interest->_delIndicesInterest($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}