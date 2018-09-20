<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Quote_Coins extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mquote_coins');
		//Idioma
		$this->lang->load('quote_coins', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "quote_coins",
			"conf"        => $this->_conf,
			"lista"  	  => $this->mquote_coins->_getQuoteCoins(),
			"novedades"  => $this->mquote_coins->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vquote_coins',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
		$resp = $this->mquote_coins->_getFullData(
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

	public function newQuoteCoin(){
		$data = array(
			"type"    => $this->security->xss_clean($this->input->post('type')),
			"date"    => $this->security->xss_clean($this->input->post('date')),
			"purchase"    => $this->security->xss_clean($this->input->post('purchase')),
			"sale"    => $this->security->xss_clean($this->input->post('sale'))
		);

		if($data['date']==""){
			header('location:'.base_url().'parameters/quote_coins?msg=emptyDate');
			exit;
		}

		if($data['purchase']==""){
			header('location:'.base_url().'parameters/quote_coins?msg=emptyPurchase');
			exit;
		}

		if($data['sale']==""){
			header('location:'.base_url().'parameters/quote_coins?msg=emptySale');
			exit;
		}

		$resp = $this->mquote_coins->_newQuoteCoin($data);

		if($resp){
			header('location:'.base_url().'parameters/quote_coins?msg=SuccessInsert');
		}else{
			header('location:'.base_url().'parameters/quote_coins?msg=FailedInsert');
		}
	}

	public function updateQuoteCoin(){
		$data = array(
			'id'        => $this->security->xss_clean($_POST['id']),
			'date'    => $this->security->xss_clean($_POST['date']),
			'purchase'    => $this->security->xss_clean($_POST['purchase']),
			'sale'    => $this->security->xss_clean($_POST['sale'])
		);
		$resp = $this->mquote_coins->_updateQuoteCoin($data);
		if($resp){
			header('location:'.base_url().'parameters/quote_coins?msg=SuccessUpdate');
			exit;
		}else{
			header('location:'.base_url().'parameters/quote_coins?msg=FailedUpdate');
			exit;
		}
	}

	public function delQuoteCoin(){
		$data = array(
			$this->security->xss_clean($_POST['id']),
			$this->security->xss_clean($_POST['clave']),
		);
		$resp = $this->mquote_coins->_delQuoteCoin($data);
		if($resp){
			echo "200";
			exit;
		}else{
			echo "201";
			exit;
		}
	}

}