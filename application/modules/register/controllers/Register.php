<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;
class Register extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mregister');
		$this->_email = new Myemail();
		$this->load->library('recaptcha');
		//Idioma
	}
	
	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname'],
			"clase"       => "base",
			"conf"        => $this->_conf
		];


		$this->load->view('Vregister',$data);

	}//

	public function contact(){

		$recaptcha = $this->input->post('captcha');
		if ($recaptcha=="") {
			echo "201";
			exit;
		}
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) and $response['success'] === false) {
			echo "201";
			exit;
		}

		$datos = array(
			'nombre'	=>	$this->security->xss_clean($_POST['nombre']),
			'email'	=>	$this->security->xss_clean($_POST['email']),
			'asunto'	=>	$this->security->xss_clean($_POST['asunto']),
			'mensaje'	=>	$this->security->xss_clean($_POST['mensaje']),
		);

		$d = "<ul>";
		$d .= "<li>Nombre: ".$datos['nombre']."</li>";
		$d .= "<li>Email: ".$datos['email']."</li>";
		$d .= "<li>Asunto: ".$datos['asunto']."</li>";
		$d .= "<li>Mensaje: ".$datos['mensaje']."</li>";
		$d .= "</ul>";
		$p = "Contacto Web por ".$datos['nombre'].", Email: ".$datos['email'].", Asunto: ".$datos['asunto'].", Mensaje: ".$datos['mensaje'];

		try{
			$email = $this->_email
					->from(['support@trueley.com','Equipo TrueLey','Contacto Web Trueley'])
                    ->to(['matias.estigarribia2112@gmail.com','Matias Estigarribia',$d,$p])
					->send();
			echo "200";
			exit;
			
		}catch(Exception $e){
			echo "fail";
			exit;
		}

	}//

}
