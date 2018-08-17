<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mbase extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
    }

    private function setHistorial($x){
        $h = array(
            'fecha'       => $this->_general->date()->datetime,
            'usuario'     => $this->_session->data->nombre,
            'asunto'      => $x[0],
            'descripcion' => $x[1]
        );
        $this->db->insert('historial',$h);
    }
}
