<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;
use GuzzleHttp\Client;


class Home extends MX_Controller {
	

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->email = new Myemail();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mhome');
		$this->lang->load('inicio', $this->_session->data->idioma);
		$this->_client = new Client();
	}
	
	public function index()
	{	
		
		if($this->_session->data->nivel=="Client" && !$this->mhome->_getAfiliate()){	
			$aft = true;
		}else{
			$aft = false;
		}

		$data = [
			"url"       => base_url(),
			"titulo"    => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"     => "desktop",
			"conf"      => $this->_conf
		];
		if($this->_session->data->nivel == "Admin" || $this->_session->data->nivel=="Webmaster"){
			$data['numeros']	= 	$this->mhome->_getNumbers();
			$data['ultimos']	= 	$this->mhome->_lastCLients();
			$data['novedades']	= 	$this->mhome->_getNovedadesAdmin();
		}

		if($this->_session->data->nivel == "User" || $this->_session->data->nivel == "Client"){
			$data['numeros']	=	$this->mhome->_getNumeros();
			$data['timeline']	=	$this->mhome->_getTimeline();
			$data['afilia']	= $aft;
			$data['novedades']	= $this->mhome->_getNovedades();
		}

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vhome',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}


	public function completePayment(){
		if(isset($_GET['preapproval_id'])){
			$id = $_GET['preapproval_id'];
			$resp = $this->mhome->_completePaymet($id);
			if($resp){
				header('location:'.base_url().'home?msg=successAfiliation');
			}else{
				header('location:'.base_url().'home?msg=failedAfiliation');
			}
		}
	}//

}
