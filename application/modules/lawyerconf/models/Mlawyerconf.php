<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mlawyerconf extends CI_model
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
    }//

    public function _getNovedades(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('$cod','All') ORDER BY idNovedad DESC LIMIT 20");
        return  ($q->num_rows()>=1) ? $q->result() : false;
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


    public function _payment($x){

        $hoy = strtotime($this->_general->date()->datetime);
        $pago = strtotime($this->_getClient()->info->proximopago);

        if($hoy < $pago){
            $dif = $this->_general->diferencia(array($this->_general->date()->datetime,$this->_getClient()->info->proximopago));
            $sum = 30 + $dif;
            $fech = strtotime('+'.$sum.' day', strtotime($this->_general->date()->datetime));
            $nfech = date("Y-m-d H:i:s", $fech);
        }else{
            $dif = 0;
            $sum = 30 + $dif;
            $fech = strtotime('+'.$sum.' day', strtotime($this->_general->date()->date));
            $nfech = date("Y-m-d H:i:s", $fech);
        }

        $this->db->trans_begin();

        if($x['collection_status']=="approved"){

            $in = array(
                'codcliente'     => $this->_session->data->codcliente,
                'fechapago'      => $this->_general->date()->datetime,
                'codpago'        => $x['collection_id'],
                'external'       => $x['external_reference'],
                'estatus'        => $x['collection_status'],
                'preferencia'    => $x['preference_id'],
                'payment_type'   => $x['payment_type'],
                'merchant_order' => $x['merchant_order_id'],
                'monto'          => $this->_getClient()->plan->costopeso
            );
            $this->db->insert('pagosmp',$in);

            $this->db->set('fechapago',$in['fechapago']);
            $this->db->set('proximopago',$nfech);
            $this->db->set('estatus','1');
            $this->db->where('codcliente =',$this->_session->data->codcliente);
            $this->db->update('clientes');

            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                return "1";
            }else{
                $this->db->trans_rollback();
                return false;
            }

        }else if($x['collection_status']=="in_process"){
            $in = array(
                'codcliente'     => $this->_session->data->codlciente,
                'fechapago'      => $this->_general->date()->datetime,
                'codpago'        => $x['collection_id'],
                'external'       => $x['external_reference'],
                'estatus'        => $x['collection_status'],
                'preferencia'    => $x['preference_id'],
                'payment_type'   => $x['payment_type'],
                'merchant_order' => $x['merchant_order_id'],
                'monto'          => $this->_getClient()->plan->costopeso
            );
            $this->db->insert('pagosmp',$in);

            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                return "2";
            }else{
                $this->db->trans_rollback();
                return false;
            }
        }
        
    }//

    public function _getPayments(){
        $this->db->select('*');
        $this->db->from('pagosmp');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->order_by('idPago','DESC');
        $q = $this->db->get();

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//


}
