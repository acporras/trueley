<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Madministracion extends CI_model
{
    public function __construct(){
        parent::__construct();
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


    public function _getTotales(){
        $ret = array();
        $glob = $this->db->query("SELECT SUM(receive) as total FROM totales");
        $ret['total'] = ($glob->num_rows()>=1) ? $glob->row()->total : '0';
        
        $m = date("m", strtotime($this->_general->date()->datetime));
        $mes = $this->db->query("SELECT SUM(receive) as mes FROM totales WHERE mes = '$m'");
        $ret['mes'] = ($mes->num_rows()>=1) ? $mes->row()->mes : '0';

        return $ret;
    }//

    public function _getPayments(){
        $p = $this->db->query("SELECT * FROM pagosmp ORDER BY idPago DESC LIMIT 20");
        return ($p->num_rows()>=1) ? $p->result() : false;
    }//

    public function _getRecaud(){
        $p = $this->db->query("SELECT * FROM totales");
        return ($p->num_rows()>=1) ? $p->result() : false;
    }//
}
