<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mrestore extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
    }

    private function setHistorial($x){
        $h = array(
            'fecha'       => $this->_general->date()->datetime,
            'usuario'     => $this->_session->data->nombre,
            'asunto'      => $x[0],
            'descripcion' => $x[1]
        );
        $this->db->insert('historial',$h);
    }//

    private function _validRecu($x){
        $this->db->select('*');
        $this->db->from('recuperaclaves');
        $this->db->where('codigo =',$x->data->codigo);
        $this->db->where('estatus =','1');
        $q = $this->db->get();
        if($q->num_rows()==1){
            $this->db->where('idRecu =',$q->row()->idRecu);
            $this->db->delete('recuperaclaves');
            return true;
        }else{
            return false;
        }
    }//

    public function _complete($x){
        $_session = $this->_valid->_Check($x[1]);

        $clave = $this->_general->claveUsuario($x[0]);

        if(!$this->_validRecu($_session)){
            return false;
        }

        $this->db->trans_begin();

        $this->db->set('pass',$clave);
        $this->db->set('hash',$x[0]);
        $this->db->where('codcliente =',$_session->data->codcliente);
        $this->db->where('usuario =',$_session->data->usuario);
        $this->db->update('usuarios');

        if($this->db->trans_complete()===true){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//
}
