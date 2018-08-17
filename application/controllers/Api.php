<?php
/**
 * Controlador API de Proyectos
 * Autor: Carlos Quintero
 * email: direccion@hitcel.com
 */
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('mapi');
    }

    public function test_get(){
        $data = (object) array(
            "codigo" => "200",
            "msg"    => "Conexion Correcta"
        );
        return $this->response($data);
    }

    public function loginRemoto_post(){
        $resp = $this->mapi->_loginRemoto($_POST);
        
        return $this->response($resp);
    }
}
