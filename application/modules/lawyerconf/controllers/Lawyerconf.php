<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Lawyerconf extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mlawyerconf');
		//Idioma
		$this->lang->load('lawyerconf', $this->_session->data->idioma);

	}
	
	public function index()
	{	

		$client = $this->mlawyerconf->_getClient();

		
		$data = [
			"url"    => base_url(),
			"titulo" => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"  => "lawyerconf",
			"conf"   => $this->_conf,
			"datos"  => $client,
			"pagos"  => $this->mlawyerconf->_getPayments(),
			"novedades"  => $this->mlawyerconf->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vlawyerconf',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}

}
