<?php
/**
 * Modelo encargado de las consultas de los diferentes metodos
 * solicitados por la Api Rest
 * Autor: Carlos Quintero
 * email: direccion@hitcel.com
 */
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;

class Mapi extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->_general = new GeneralClass();
        $this->_valid = new Valid();
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $this->load->library('my_enc');
    }

    //VALIDACION DE TOKEN------------------------------------------------------
    private function _shaValid()
    {
        $sha = $this->_conf['sharemoto'];
        $sha .= $this->_general->date()->date;
        
        return  hash('ripemd160',sha1($sha));
    }//

    private function _validToken($X){
        $ret = $this->_valid->_CheckRemote($X);

        if(!$ret->error && $ret->data->sha == $this->_shaValid()){
            return $ret;
        }else{
            return $ret;
        }
    }
    //END -> VALIDACION DE TOKEN-------------------------------------------------

}