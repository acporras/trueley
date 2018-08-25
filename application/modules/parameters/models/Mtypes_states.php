<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mtypes_states extends CI_model
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

    public function _getTypesStates(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT te.*, md.campo1 as movimiento FROM tipo_estado te
            INNER JOIN maestro_datos md ON md.campo2 = te.codmovimiento
                AND md.tipo_maestro = 'Movimientos'
            WHERE codcliente = '$cod' 
            ORDER BY md.fechareg DESC");

        $r = (object) array(
            'cantidad' => $q->num_rows(),
            'datos'    => $q->result()
        );
        return $r;
    }

    public function _getMovimientos(){
        $q = $this->db->query("SELECT * FROM maestro_datos
            WHERE tipo_maestro = 'Movimientos'
            ORDER BY fechareg DESC");

        $r = (object) array(
            'cantidad' => $q->num_rows(),
            'movimientos'    => $q->result()
        );
        return $r;
    }

    public function _getTypeState(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT * FROM tipo_estado WHERE codcliente = '$cod' ORDER BY
            fechareg DESC");

        $r = (object) array(
            'cantidad' => $q->num_rows(),
            'datos'    => $q->result()
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

    public function _newTYpeState($x){
        $data = array(
            "descripcion"     => $x['description'],
            "codmovimiento"     => $x['movement'],
            "codcliente" => $this->_session->data->codcliente,
            "estatus"    => "1",
            "fechareg"   => $this->_general->date()->datetime
        );

        $this->db->trans_begin();

        $this->db->insert('tipo_estado',$data);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    public function _updateTypeState($x){
        $this->db->trans_begin();
        $this->db->set('descripcion',$x['description']);
        $this->db->set('codmovimiento',$x['movement']);
        $this->db->set('fechamod',$this->_general->date()->datetime);
        $this->db->where('idTipoEstado =',$x['id']);
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->update('tipo_estado');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            
            return true;

        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    public function _delTypeState($x){
        $u = $this->_session->data->usuario;
        $a = $this->db->query("SELECT * FROM usuarios WHERE usuario =  '$u'");

        if(password_verify($x[1], $a->row()->pass)){
            $data = $this->_getUsuarios($x[1]);

            $this->db->trans_begin();
            $this->db->where('idTipoEstado = ',$x[0]);
            $this->db->delete('tipo_estado');

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
        $q = $this->db->query("SELECT * FROM tipo_estado WHERE idTipoEstado = '$x'");

        if($q->num_rows()==1){
            return json_encode($q->row());
        }else{
        }

    }
}