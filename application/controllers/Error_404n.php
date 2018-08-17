<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use xfxstudios\general\GeneralClass;

class Error_404n extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general = new GeneralClass();
	}
	
	public function index()
	{
		$data = [
			"url"     => base_url(),
			"titulo"  => "Proyecto Base Material",
			"clase"   => "desktop",
			"mensaje" => "Bienvenidos al Proyectos General",
			"conf"	=>	json_decode(file_get_contents(APPPATH.'config/conf.json'))
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Verror',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}
}
