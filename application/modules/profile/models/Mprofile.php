<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use GuzzleHttp\Client;
class Mprofile extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $this->_client = new Client();
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

    public function _getDatos($x){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('codcliente =',$x);
        $q = $this->db->get();

        $data = (object) array(
            "info" =>  $q->row(),
            "numeros"   =>  $this->_getNumeros($q->row()->codcliente),
            "histo"   =>  $this->_getPayments($q->row()->codcliente),
            "historial" =>  $this->_getTimeLine($q->row()->codcliente)
        );
        return ($q->num_rows()===1) ? $data : false;
    }//

    private function _getCliente($x){
        $a = $this->db->query("SELECT * FROM clientes WHERE idCliente = '$x'");
        return ($a->num_rows()>=1) ? $a->row() : false;
    }//

    public function _datosPlan($x){
        $q = $this->db->query("SELECT * FROM planes WHERE codplan = '$x'");
        return $q->row();
    }//

    public function _getNumeros($x){
        $this->db->select('*');
        $this->db->from('numeros');
        $this->db->where('codcliente =',$x);
        return $this->db->get()->row();
    }//
    
    public function _getHistoPagos($x){
        $this->db->select('*');
        $this->db->from('histopagos');
        $this->db->where('codcliente =',$x);
        $this->db->order_by('idHisto','DESC');
        $this->db->limit(50);
        $q = $this->db->get();

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

    public function _estatus($x){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario =',$this->_session->data->usuario);

        $q = $this->db->get()->row();

        if(password_verify($x['clave'], $q->pass)){

            switch($x['tipo']){
                case 'activar':
                    $this->db->set('estatus','1');
                    //$this->db->set('estado','1');
                    $this->db->where('idCliente =',$x['id']);
                    $this->db->update('clientes');
                    $this->setHistorial(array('Activación de Cliente','Se ha activado al Cliente '.$this->_getCliente($x['id'])->nombrefirma ));

                    $id = $x['id'];
                    $dats = $this->_getCliente($x['id']);
                    $mp = new MP ($this->_conf['prod_client_id'], $this->_conf['prod_client_secret']);
                    $mp->update_preapproval_payment($dats->autmp, "{\"status\":\"authorized\"}");
                break;

                case 'inactivar':
                $this->db->set('estatus','0');
                    //$this->db->set('estado','0');
                    $this->db->where('idCliente =',$x['id']);
                    $this->db->update('clientes');
                    $this->setHistorial(array('Suspensión de Cliente','Se ha suspendido al Cliente '.$this->_getCliente($x['id'])->nombrefirma ));
                    
                    $id = $x['id'];
                    $dats = $this->_getCliente($x['id']);
                    $mp = new MP ($this->_conf['prod_client_id'], $this->_conf['prod_client_secret']);
                    $mp->update_preapproval_payment($dats->autmp, "{\"status\":\"paused\"}");
                break;
                
                case 'eliminar':
                    $id = $x['id'];
                    $dats = $this->_getCliente($x['id']);

                    //Actualizamos al plam
                    $this->db->set('registroplan','registroplan - 1',false);
                    $this->db->where('codplan =',$dats->plan);
                    $this->db->update('planes');

                    //Registram,os el historial
                    $this->setHistorial(array('Eliminación de Cliente','Se ha eliminado al Cliente '.$dats->nombrefirma.' por '.$this->_session->data->nombre));

                    //Registramos la novedad
                    $novedadb = array(
                        'fecha'	=>	$this->_general->date()->datetime,
                        'para'	=>	'Admin',
                        'tipo'	=>	'clientes',
                        'info'	=>	'Se ha eliminado al Cliente '.$dats->nombrefirma.' por '.$this->_session->data->nombre
                    );
                    $this->db->insert('novedades',$novedadb);

                    //Eliminamos al usuario
                    $this->db->where('codcliente =',$dats->codcliente);
                    $this->db->where('status !=','approved');
                    $this->db->delete('pagosmp');

                    if($dats->plan != 'demo' && $dats->autmp != ""){
                        try{
                            $mp = new MP ($this->_conf['prod_client_id'], $this->_conf['prod_client_secret']);
                            $mp->update_preapproval_payment($dats->autmp, "{\"status\":\"paused\"}");

                        }catch(Exception $e){
                            //$e->getMessage();
                        }
                    }

                    $this->db->query("DELETE FROM clientes WHERE idCliente = '$id'");

                break;
            }
            return true;
        }else{
            return false;
        }
    }//

    public function _sendMessage($x){
        $this->db->trans_begin();

        $in = array(
            'codcliente' => $x['codcliente'],
            'fecha'      => $this->_general->date()->datetime,
            'tipo'       => 'private',
            'estatus'    => '',
            'mensaje'   =>  $x['mensaje']
        );
        $this->db->insert('mensajes',$in);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//


    public function _getTimeline($x){

        $this->db->select('*');
        $this->db->from('movimientos');
        $this->db->where('codcliente =',$x);
        $this->db->order_by('idMovi','DESC');
        $this->db->limit(50);
        $q = $this->db->get();
        return ($q->num_rows() >=1 ) ? $q->result() : false;
    }//

    public function _getPayments($x){
        $q = $this->db->query("SELECT * FROM pagosmp WHERE codcliente = '$x' ORDER BY idPago DESC LIMIT 50");

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//
}
