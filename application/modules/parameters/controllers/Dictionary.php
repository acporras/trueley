<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Dictionary extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mdictionary');
		//Idioma
		$this->lang->load('dictionary', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "dictionary",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mdictionary->_getDictionary(),
			"novedades"  => $this->mdictionary->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vdictionary',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mdictionary->_getFullData(
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

	public function newWord(){
		$data = array(
			"word"    => $this->security->xss_clean($this->input->post('word'))
		);

		if($data['word']==""){
			header('location:'.base_url().'parameters/dictionary?msg=emptyWord');
			exit;
		}

		$resp = $this->mdictionary->_newWord($data);

		if($resp){
			header('location:'.base_url().'parameters/dictionary?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/dictionary?msg=FailedInsert');
		}
	}

	public function updateWord(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'word'    => $this->security->xss_clean($_POST['word'])
		);
		$resp = $this->mdictionary->_updateWord($data);
		if($resp){
			header('location:'.base_url().'parameters/dictionary?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/dictionary?msg=FailedUpdate');
			exit;
		}
	}

	public function delWord(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mdictionary->_delWord($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}