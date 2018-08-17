<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\TranslateClass;

class Translate extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mtranslate');
		//Idioma
		$this->lang->load('translate', 'spanish');
	}
	
	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "translate",
			"conf"        => $this->_conf
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		//$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vtranslate',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}

	public function trans(){
		$m = $_POST['msg'];

		$s = 'es';//source
		$t = 'en';//target
		$tx = $m;//texto
		$trans = new TranslateClass();

		try{
			$result = $trans->translate($s,$t,$tx);
			$data = (object) array(
				'fecha'	=> $this->general->date()->date.' '.$this->general->date()->microtime,
				'saliente'	=>	$tx,
				'entrante'	=>	$result
			);
		}catch(Exception $e){
			$data = (object) array(
				'fecha'	=> $this->general->date()->date.' '.$this->general->date()->microtime,
				'saliente'	=>	'Error',
				'entrante'	=>	$e->getMessage()
			);
		}
		echo json_encode($data);
	}

}