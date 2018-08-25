<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Expedientes extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mexpedientes');
		//Idioma
		$this->lang->load('expedientes', $this->_session->data->idioma);
		$this->load->library('juzgados');
		
	}
	
	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "expedientes",
			"conf"        => $this->_conf,
			"exp"		=>	$this->mexpedientes->_getLista(),
			"novedades"  => $this->mexpedientes->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vexpedientes',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function newCaseFile(){
		$expe = ltrim($this->security->xss_clean($_POST['expediente']));
		$bis = ltrim($this->security->xss_clean($_POST['bisdata']));
		
		$expe = rtrim($this->security->xss_clean($_POST['expediente']));
		$bis = rtrim($this->security->xss_clean($_POST['bisdata']));
		
		$data = array(
			'expediente'      => $expe,
			'portada'         => $this->security->xss_clean($_POST['portada']),
			'bis'             => $this->security->xss_clean($_POST['bis']),
			'bisdata'         => $bis,
			'circunscripcion' => $this->security->xss_clean($_POST['circunscripcion']),
			'localidad'       => $this->security->xss_clean($_POST['localidad']),
			'juzgado'         => $this->security->xss_clean($_POST['juzgado']),
			'observacion'     => $this->security->xss_clean($_POST['observacion']),
		);

		$resp = $this->mexpedientes->_newCaseFile($data);
		
		if($resp){
			header('location:'.base_url().'expedientes?msg=success');
			exit;
		}else{
			header('location:'.base_url().'expedientes?msg=failed');
			exit;
		}
	}//
	
	public function editCaseFile(){
		$expe = ltrim($this->security->xss_clean($_POST['expedienteedit']));
		$bis = ltrim($this->security->xss_clean($_POST['bisdata']));
		
		$expe = rtrim($this->security->xss_clean($_POST['expedienteedit']));
		$bis = rtrim($this->security->xss_clean($_POST['bisdata']));

		$data = array(
			'expediente'      => $expe,
			'portada'         => $this->security->xss_clean($_POST['portadaedit']),
			'bis'             => $this->security->xss_clean($_POST['bisedit']),
			'bisdata'         => $bis,
			'circunscripcion' => $this->security->xss_clean($_POST['circunscripcionedit']),
			'localidad'       => $this->security->xss_clean($_POST['localidadedit']),
			'juzgado'         => $this->security->xss_clean($_POST['juzgadoedit']),
			'observacion'     => $this->security->xss_clean($_POST['observacionedit']),
			'id'              => $this->security->xss_clean($_POST['idedit']),
		);

		$resp = $this->mexpedientes->_editCaseFile($data);
		
		if($resp){
			header('location:'.base_url().'expedientes?msg=success');
			exit;
		}else{
			header('location:'.base_url().'expedientes?msg=failed');
			exit;
		}
	}//


	public function getciscunscripcion(){		
		$data = $this->juzgados->_getCircunscirpciones();

		echo json_encode($data);
	}//

	public function getlocal(){
		$cir = $this->security->xss_clean($_POST['valor']);
		
		$data = $this->juzgados->_getLocalidad($cir);

		echo json_encode($data);
	}//
	
	public function getjuzgado(){
		$cir = $this->security->xss_clean($_POST['valora']);
		$loc = $this->security->xss_clean($_POST['valorb']);


		$data = $this->juzgados->_getJuzgados($cir,$loc);

		echo json_encode($data);
		exit;
	}//


	public function validfile(){
		$expe = ltrim($this->security->xss_clean($_POST['expe']));
		$juz = ltrim($this->security->xss_clean($_POST['juzgado']));
		
		$expe = rtrim($this->security->xss_clean($_POST['expe']));
		$juz = rtrim($this->security->xss_clean($_POST['juzgado']));

		$data = array(
			'expediente' => $expe,
			'juzgado'    => $juz
		);


		$resp = $this->juzgados->_getCaseFile($data);
		if($resp){
			echo json_encode($resp);
			exit;
		}else{
			$r = (object) array('cod'	=>	'201');
			echo json_encode($r);
			exit;
		}
	}//


	public function generalUpdate(){
		$resp = $this->mexpedientes->_generalUpdate();
		echo $resp;
		exit;
	}//
	
	public function lineUpdate(){
		$resp = $this->mexpedientes->_lineUpdate($this->security->xss_clean($_POST['id']));
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//
	
	public function lineDelete(){
		$resp = $this->mexpedientes->_lineDelete(array( $this->security->xss_clean($_POST['id']), $this->security->xss_clean($_POST['clave']) ));
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}//
	public function getFullData(){
		$resp = $this->mexpedientes->_getFullData(
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


}
