<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Interes_rate extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('minteres_rate');
		//Idioma
		$this->lang->load('interes_rate', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "interes_rate",
			"conf"        => $this->_conf,
			"lista"  	  => $this->minteres_rate->_getInteresRate(),
			"mae_metodos" => $this->minteres_rate->_getMetodos(),
			"novedades"  => $this->minteres_rate->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vinteres_rate',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->minteres_rate->_getFullData(
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

	public function newInteresRate(){
		$data = array(
			"description"    => $this->security->xss_clean($this->input->post('description')),
			"method"    => $this->security->xss_clean($this->input->post('method'))
		);

		if($data['description']==""){
			header('location:'.base_url().'parameters/interes_rate?msg=emptyDescription');
			exit;
		}

		$resp = $this->minteres_rate->_newInteresRate($data);

		if($resp){
			header('location:'.base_url().'parameters/interes_rate?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/interes_rate?msg=FailedInsert');
		}
	}

	public function updateInteresRate(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'description'    => $this->security->xss_clean($_POST['description']),
			'method'    => $this->security->xss_clean($_POST['method'])
		);
		$resp = $this->minteres_rate->_updateInteresRate($data);
		if($resp){
			header('location:'.base_url().'parameters/interes_rate?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/interes_rate?msg=FailedUpdate');
			exit;
		}
	}

	public function delInteresRate(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->minteres_rate->_delInteresRate($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}