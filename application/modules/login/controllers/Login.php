<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;

class Login extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->general = new GeneralClass();
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mlogin');
	}
	
	public function index()
	{

		if(isset($_COOKIE['renc'])){
            $this->authRec();
        }else{
			$this->session->sess_destroy();
			$data = [
				"url"         => base_url(),
				"titulo"      => $this->_conf['appname']."",
				"clase"       => "login",
				"conf"        => $this->_conf,
				"mensaje"     => "Bienvenidos a Iscus",
			];

			$this->load->view('Vlogin',$data);
		}
	}

	//Loging de usuario desde el formulario principal
	public function signinUser(){

		$data = (object) array(
			'usuario' => $this->security->xss_clean($_POST['usuario']),
			'clave'   => $this->security->xss_clean($_POST['clave']),
			'recordar' => (isset($_POST['recordar'])) ? true : false
		);
		if(!valid_email($data->usuario)){
			header('location:'.base_url().'?msg=badEmailFormat');
			exit;
		}
		if(empty($data->clave)){
			header('location:'.base_url().'?msg=errorData');
			exit;
		}
		$resp = $this->mlogin->ingresar($data);
		if($resp){
			header('location:'.base_url().'home');
		}else{
			header('location:'.base_url().'?msg=errorData');
		}
	}


	//Login de usuario si este tiene activa la funcion de recordar usuario
	public function authRec(){
        $data = (object) array(
            "usuario"  => $this->security->xss_clean($this->encryption->decrypt($_COOKIE['uenc'])),
            "clave"    => $this->security->xss_clean($this->encryption->decrypt($_COOKIE['penc'])),
            $recordar = true,
        );
        $resp = $this->mlogin->ingresar($data);
        if($resp){
            header('location:'.base_url().'home');
        }else{
            header('location:'.base_url().'?msg=errorData');
        }
	}

	//Desconecta al usuario de la sesion actual
	public function logout(){
		$this->session->sess_destroy();
		setcookie('penc',null,-1,'/');
        setcookie('uenc',null,-1,'/');
        setcookie('renc',null,-1,'/');
        setcookie('csrf_cookie_name',null,-1,'/');
        setcookie('ci_session',null,-1,'/');
        setcookie('mycookie',null,-1,'/');
		header('location:'.base_url().'?msg=logOut');
		exit;
	}


	public function restore(){
		$email = $this->security->xss_clean($_POST['email']);

		if($email==""){
			echo "nouser";
			exit;
		}

		if(!valid_email($email)){
			echo "badformat";
			exit;
		}

		$resp = $this->mlogin->_restore($email);

		if($resp){
			echo "200";
			exit;
		}else{
			echo "nouser";
			exit;
		}
	}//


}
