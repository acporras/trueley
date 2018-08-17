<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Restorepass extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();

		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mrestore');
		//Idioma
		//$this->lang->load('restore', $this->_session->data->idioma);
		$this->uri = base_url();
	}
	
	public function index()
	{
		/*var_dump($this->uri->segment_array());
		exit;*/
		$this->_session = $this->_valid->_Check($_GET['token']);
		if($this->_session->error){ 
			header('location:'.base_url().'?msg=errorTokenRecu'); exit; 
		}
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - Restaurar Clave de Acceso",
			"clase"       => "restore",
			"conf"        => $this->_conf
		];

		$this->load->view('Vrestorepass',$data);
	}

	public function complete(){
		$pass = $this->security->xss_clean($_POST['nuevaclave']);

		$resp = $this->mrestore->_complete(array($pass,$_POST['token']));

		if($resp){
			header("location:{$this->uri}?msg=successChange");
		}else{
			header("location:{$this->uri}?msg=failChange");
		}
	}

}
