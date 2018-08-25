<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mtypes_management extends CI_model
{
	public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
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
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('$cod','all') ORDER BY idNovedad DESC LIMIT 20");
        return  ($q->num_rows()>=1) ? $q->result() : false;
    }//

    public function _getTypesManagement(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT tg.*, md.campo1 as tipo_calculo FROM tipo_gestion tg
            INNER JOIN maestro_datos md on md.campo2 = tg.codcalculo
                AND md.tipo_maestro = 'FechaControl'
            WHERE codcliente = '$cod' ORDER BY
            fechareg DESC");

        $r = (object) array(
            'cantidad' => $q->num_rows(),
            'datos'    => $q->result()
        );
        return $r;
    }

    public function _getFechaControl(){
        $q = $this->db->query("SELECT * FROM maestro_datos
            WHERE tipo_maestro = 'FechaControl' ORDER BY
            fechareg DESC");

        $r = (object) array(
            'cantidad' => $q->num_rows(),
            'fechacontrol'    => $q->result()
        );
        return $r; 
    }

    public function _getUsuarios($x=null){

        $c = $this->_session->data->codcliente;

        if($x==null){
            $a = $this->db->query("SELECT * FROM usuarios WHERE codcliente = '$c'");
            if($a->num_rows()>=1){
                $r = (object) array(
                    'cantidad' => $a->num_rows(),
                    'datos'    => $a->result()
                );
                return $r;
            }else{
                return false;
            }
        }else{
            $a = $this->db->query("SELECT * FROM usuarios WHERE idUsuario = '$x' AND codcliente = '$c'");
            if($a->num_rows()>=1){
                $r = (object) array(
                    'cantidad' => $a->num_rows(),
                    'datos'    => $a->row()
                );
                return $r;
            }else{
                return false;
            }
        }

    }//

    public function _newTypeManagement($x){
        $data = array(
            "descripcion"     => $x['description'],
            "cant_calculo"     => $x['cant_calculo'],
            "codcalculo"     => $x['type_calculo'],
            "codcliente" => $this->_session->data->codcliente,
            "estatus"    => "1",
            "fechareg"   => $this->_general->date()->datetime
        );

        $this->db->trans_begin();

        $this->db->insert('tipo_gestion',$data);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    public function _updateTypeManagement($x){
        $this->db->trans_begin();
        $this->db->set('descripcion',$x['description']);
        $this->db->set('cant_calculo',$x['cant_calculo']);
        $this->db->set('codcalculo',$x['type_calculo']);
        $this->db->set('fechamod',$this->_general->date()->datetime);
        $this->db->where('idTipoGestion =',$x['id']);
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->update('tipo_gestion');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            
            return true;

        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    public function _delTypeManagement($x){
        $u = $this->_session->data->usuario;
        $a = $this->db->query("SELECT * FROM usuarios WHERE usuario =  '$u'");

        if(password_verify($x[1], $a->row()->pass)){
            $data = $this->_getUsuarios($x[1]);

            $this->db->trans_begin();
            $this->db->where('idTipoGestion = ',$x[0]);
            $this->db->delete('tipo_gestion');

            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }

        }else{
            return false;
        }
    }

    public function _getFullData($x){
        $q = $this->db->query("SELECT * FROM tipo_gestion WHERE idTIpoGestion = '$x'");

        if($q->num_rows()==1){
            return json_encode($q->row());
        }else{
        }

    }
}