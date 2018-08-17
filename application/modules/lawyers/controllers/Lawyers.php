<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Lawyers extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mlawyers');
		//Idioma
		$this->lang->load('lawyers', $this->_session->data->idioma);
	}
	
	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "lawyers",
			"conf"        => $this->_conf,
			"listas"		=>	$this->mlawyers->_getLista(),
			"planes"		=>	$this->mlawyers->_getPlanes()
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vlawyers',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function newlawyer(){
		$data = array(
			"tipocliente" => $this->security->xss_clean($this->input->post('tipocliente')),
			"nombre"      => $this->security->xss_clean($this->input->post('nombre')),
			"documento"   => $this->security->xss_clean($this->input->post('documento')),
			"usuario"     => $this->security->xss_clean($this->input->post('email')),
			"direccion"   => $this->security->xss_clean($this->input->post('direccion')),
			"telefonos"   => $this->security->xss_clean($this->input->post('telefonos')),
			"plan"        => $this->security->xss_clean($this->input->post('plan')),
		);
		
		if($data['tipocliente'] =="firma"){

			$data["emailusuario"]     = $this->security->xss_clean($this->input->post('emailusuario'));
			$data["nombreusuario"]    = $this->security->xss_clean($this->input->post('nombreusuario'));
			$data["documentousuario"] = $this->security->xss_clean($this->input->post('documentousuario'));
			
		};

		if(!valid_email($data['usuario']) || $data['usuario']==""){
			header('location:'.base_url().'lawyers?msg=emptyEmail');
			exit;
		}
		if($data['nombre']==""){
			header('location:'.base_url().'lawyers?msg=emptyName');
			exit;
		}
		if($data['documento']==""){
			header('location:'.base_url().'lawyers?msg=emptyDocument');
			exit;
		}

		$resp = $this->mlawyers->_newlawyer($data);

		if($resp){
			header('location:'.base_url().'lawyers?msg=successInsert');
			exit;
		}else{
			header('location:'.base_url().'lawyers?msg=failinsert');
			exit;
		}


	}//

	public function validuser(){
		$usuario = $this->security->xss_clean($_POST['usuario']);
		$tipo = $this->security->xss_clean($_POST['tipo']);

		if(!valid_email($usuario)){
			echo "201";
			exit;
		}

		$this->db->select('usuario');
		$this->db->from('usuarios');
		$this->db->where('usuario =',$usuario);
		$q = $this->db->get();

		echo ($q->num_rows()>=1) ? "201" : "200";
		exit;
	}//

}
