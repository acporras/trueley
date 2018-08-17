<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Profile extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mprofile');
		//Idioma
		$this->lang->load('profile', $this->_session->data->idioma);
	}
	
	public function index()
	{
		$datos = $this->mprofile->_getDatos($this->security->xss_clean($_GET['id']));

		if(!$datos){
			header('location:'.base_url().'lawyers?msg=notExits');
		}

		$data = [
			"url"    => base_url(),
			"titulo" => $this->_conf['appname']." - ".$this->lang->line('navmodulo').' '.$datos->info->nombrefirma,
			"clase"  => "lawyers",
			"conf"   => $this->_conf,
			"datos"  => $datos
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vprofile',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function estatus(){
		$data = array(
			"id"	=>	$this->security->xss_clean($this->input->post('id')),
			"clave"	=>	$this->security->xss_clean($this->input->post('clave')),
			"tipo"	=>	$this->security->xss_clean($this->input->post('tipo'))
		);

		$resp = $this->mprofile->_estatus($data);

		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//

	public function sendMessage(){
		$data = array(
			"mensaje"	=>	$this->security->xss_clean($_POST['mensaje']),
			"codcliente"	=>	$this->security->xss_clean($_POST['codcliente'])
		);

		$resp = $this->mprofile->_sendMessage($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//

}
