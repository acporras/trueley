<?php

//use Google\Cloud\Storage\StorageClient;
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use GuzzleHttp\Client;

class Mhome extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $this->_client = new Client();
    }//

    public function _getNovedades(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('$cod','All') ORDER BY idNovedad DESC LIMIT 20");
        return  ($q->num_rows()>=1) ? $q->result() : false;
    }//

    public function _getNumbers(){
        $this->db->query("SET SESSION sql_mode = ''");

        $resp = array();

        $cli = $this->db->query("SELECT COUNT(idCliente) as cli FROM clientes WHERE codcliente !='home'");
        $resp['clientes'] = ($cli->num_rows()>=1) ? $cli->row()->cli : '0;';
        
        $abo = $this->db->query("SELECT COUNT(idUsuario) as usu,nivel FROM usuarios WHERE nivel IN ('User','Client') ");
        $resp['abogados'] = ($abo->num_rows()>=1) ? $abo->row()->usu : '0;';

        $glob = $this->db->query("SELECT SUM(expedientes) as expe, SUM(despachados) as desp, SUM(pendientes) as pendi, SUM(eliminados) as elimi FROM numeros");
        
        if($glob->num_rows()>=1){
            $resp['expedientes'] = $glob->row()->expe;
            $resp['despachados'] = $glob->row()->desp;
            $resp['pendientes'] = $glob->row()->pendi;
            $resp['eliminados'] = $glob->row()->elimi;
        }else{
            $resp['expedientes'] = '0';
            $resp['despachados'] = '0';
            $resp['pendientes']  = '0';
            $resp['eliminados']  = '0';
        }

        return $resp;

    }//

    public function _getNumeros(){
        $this->db->select('*');
        $this->db->from('numeros');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $q = $this->db->get()->row();
        return $q;
    }//

    public function _getTimeline(){
        $this->db->select('*');
        $this->db->from('movimientos');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->order_by('idMovi','DESC');
        $this->db->limit(50);
        $q = $this->db->get();
        return ($q->num_rows() >=1 ) ? $q->result() : false;
    }//

    public function _getClient(){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $q = $this->db->get()->row();

        $resp = (object) array(
            'info'  => $q,
            'plan'   => $this->_getPlan($q->plan),
            'admins' => $this->_getAdmin()
        );
        return $resp;
    }//

    public function _getPlan($x=null){
        if($x==null){
            $a = $this->db->query("SELECT * FROM planes");
            return ($a->num_rows()>=1) ? $a->result() : false;
        }else{
            $a = $this->db->query("SELECT * FROM planes WHERE codplan = '$x' ");
            return $a->row();
        }
    }//

    public function _getAdmin($x=null){
        if($x==null){
            $a = $this->db->query("SELECT * FROM usuarios WHERE nivel = 'Client'");
            return ($a->num_rows()>=1) ? $a->result() : false;
        }else{
            $cod = $this->_session->data->codcliente;
            $a = $this->db->query("SELECT * FROM planes WHERE idUsuario = '$x' AND codcliente = '$cod' ");
            return $a->row();
        }
    }//

    public function _getAfiliate(){
        $this->db->select('codcliente, afiliacion');
        $this->db->from('clientes');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $q = $this->db->get();
        return $q->row()->afiliacion;
    }//

    public function _mp(){
            
        $client = $this->_getClient();
        return $client->plan->boton;
        
    }//

    public function _completePaymet($x){
        $this->db->trans_begin();

        $this->db->set('autmp',$x);
        $this->db->set('pagoinicial','1');
        $this->db->set('afiliacion','1');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->update('clientes');

        if($this->db->trans_complete()===true){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//

    public function _lastCLients(){
        $q = $this->db->query("SELECT * FROM clientes WHERE codcliente !='home' ORDER BY idCliente DESC LIMIT 20 ");
        return ($q->num_rows()>=1) ? $q->result() : false;
    }//
    
    public function _getNovedadesAdmin(){
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('Admin','All') ORDER BY idNovedad DESC LIMIT 20");
        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

}

?>