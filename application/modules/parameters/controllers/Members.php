<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Members extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->general  = new GeneralClass();
		$this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->session->token);
		//Validacion de Token
		if($this->_session->error){ header('location:'.base_url().'?msg='.$this->_session->message); exit; }else{ $sesdata = (array) $this->_session->data; $_SESSION['token'] = $this->_valid->_SignIn($sesdata); }
		//---------
		$this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
		$this->load->model('mmembers');
		//Idioma
		$this->lang->load('members', $this->_session->data->idioma);
	}

	public function index()
	{
		$data = [
			"url"         => base_url(),
			"titulo"      => $this->_conf['appname']." - ".$this->lang->line('navmodulo'),
			"clase"       => "members",
			"conf"        => $this->_conf,
			"lista"		  => $this->mmembers->_getMembers(),
			"novedades"   => $this->mmembers->_getNovedades(),
		];

		$this->load->view('layouts/admin/Header',$data);
		$this->load->view('layouts/admin/Navbar',$data);
		$this->load->view('layouts/admin/Sidebar',$data);
		$this->load->view('Vmembers',$data);
		$this->load->view('layouts/admin/Footer',$data);
	}//

	public function getFullData(){
        $resp = $this->mmembers->_getFullData(
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

    public function newMember(){
        $data = array(
            "name"    => $this->security->xss_clean($this->input->post('name')),
            "phone"    => $this->security->xss_clean($this->input->post('phone')),
            "email"    => $this->security->xss_clean($this->input->post('email'))
        );

        if($data['name']==""){
            header('location:'.base_url().'parameters/members?msg=emptyName');
            exit;
        }

        $resp = $this->mmembers->_newMember($data);

        if($resp){
            header('location:'.base_url().'parameters/members?msg=SuccessInsert');
        }else{
            header('location:'.base_url().'parameters/members?msg=FailedInsert');
        }
    }

    public function updateMember(){
        $data = array(
            'id'        => $this->security->xss_clean($_POST['id']),
            'name'    => $this->security->xss_clean($_POST['name']),
            'phone'    => $this->security->xss_clean($_POST['phone']),
            'email'    => $this->security->xss_clean($_POST['email'])
        );
        $resp = $this->mmembers->_updateMember($data);
        if($resp){
            header('location:'.base_url().'parameters/members?msg=SuccessUpdate');
            exit;
        }else{
            header('location:'.base_url().'parameters/members?msg=FailedUpdate');
            exit;
        }
    }

    public function delMember(){
        $data = array(
            $this->security->xss_clean($_POST['id']),
            $this->security->xss_clean($_POST['clave']),
        );
        $resp = $this->mmembers->_delMember($data);
        if($resp){
            echo "200";
            exit;
        }else{
            echo "201";
            exit;
        }
    }

}