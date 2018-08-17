<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;
class Mclientusers extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_email = new Myemail();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
    }

    private function setHistorial($x){
        $h = array(
            'codcliente' => $this->_session->data->codcliente,
            'fecha'      => $this->_general->date()->datetime,
            'tipo'       => $x[0],
            'info'       => $x[1],
        );
        $this->db->insert('movimientos',$h);
    }

    public function _getNovedades(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('$cod','All') ORDER BY idNovedad DESC LIMIT 20");
        return  ($q->num_rows()>=1) ? $q->result() : false;
    }//

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

    public function _deleteUser($x){
        $u = $this->_session->data->usuario;
        $a = $this->db->query("SELECT * FROM usuarios WHERE usuario =  '$u'");

        if(password_verify($x[1], $a->row()->pass)){
            $data = $this->_getUsuarios($x[1]);

            $this->db->trans_begin();
            $this->db->where('idUsuario = ',$x[0]);
            $this->db->delete('usuarios');

            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                $this->setHistorial(array('Eliminación',$this->_session->data->nombre.' ha eliminado al usuario '.$data->datos->nombre.' del sistema.'));
                return true;
            }else{
                $this->db->trans_rollback();
                //$this->setHistorial(array('Intento de Eliminación de Usuario',$this->_session->data->nombre.' ha intentado eliminar al usuario '.$data->datos->nombre.' del sistema.'));
                return false;
            }

        }else{
            return false;
        }

    }//

    public function _updateUser($x){
        
        $this->db->trans_begin();

        $this->db->set('nombre',$x['nombre']);
        $this->db->set('documento',$x['documento']);
        /*if($x['cambio']){
            if(valid_email($x['email'])){
                $this->db->set('usuario',$x['email']);
            }
        }*/
        $this->db->where('idUsuario =',$x['id']);
        $this->db->where('codcliente =',$this->_session->data->codcliente);

        $this->db->update('usuarios');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Actualización',$this->_session->data->nombre.' ha actualizado los datos de '.$x['nombre'].' en el sistema.'));
            
            if($x['cambio']){
                if(valid_email($x['email'])){
                    $html = '';
                    $plano = '';
                    /*$email = $this->_email
                            ->from(['support@trueley.com','Soporte al Usuario TrueLey','Actualización de usuario'])
                            ->to([$x['email'],$x['nombre'],$html,$plano])
                            ->template([TRUE,'updateuser.htm'])
                            ->send();
                    }*/
                }
            }
            return true;

        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//

    public function _sendMail($x){
        $c = $this->_session->data->codcliente;

        $a = $this->db->query("SELECT idUsuario, codcliente, usuario, nombre, documento, foto, idioma FROM usuarios WHERE idUsuario = '$x' AND codcliente = '$c' ");

        $r = $a->row();
        
        $cod = 'rec-'.uniqid().'-'.$this->_general->date()->unix;

        $datos = array(
            'codcliente' => $r->codcliente,
            'usuario'    => $r->usuario,
            'nombre'     => $r->nombre,
            'documento'  => $r->documento,
            'idioma'     => $r->idioma,
            'foto'       => $r->foto,
            'sha'        => $this->_shaValid(),
            'codigo'     => $cod
        );
        $token = $this->_valid->_SignIn($datos);

        $ins = array(
            'fecha'   => $this->_general->date()->datetime,
            'codigo'  => $datos['codigo'],
            'token'   => $token,
            'email'   => $x,
            'estatus' => '1'
        );
        $this->db->insert('recuperaclaves',$ins);

        
        $url = base_url('newpass/valid/'.$token);

        $msg = $this->_getMessages();
        $nu = $msg->mensajeclave;
        $nu = str_replace("%name%",ucwords($r->nombre),$nu);
        $nu = str_replace("%url%","<a href='".base_url()."restorepass?token={{var:token:\"\"}}&user={{var:user:\"\"}}'>Restaurar Clave</a>",$nu);

        
        $email = $this->_email
                ->from(['support@trueley.com','Equipo TrueLey','Recuperar Clave de TrueLey.com'])
                ->to([$r->usuario,$r->nombre,$nu,$nu])
                ->template([TRUE,'restorepass.htm'])
                ->variables([TRUE,['token'=>$token,'user'=>$r->usuario]])
                ->send();

        return "200";

    }//

    private function _getMessages(){
        $this->db->select('mensajenuevo, mensajeclave');
        $this->db->from('configuracion');
        $q = $this->db->get()->row();
        return $q;
    }//

    private function _shaValid()
    {
        $sha = $this->_conf['sharemoto'];
        $sha .= $this->_general->date()->date;
        
        return hash('ripemd160',sha1($sha));
    }//


    public function _newUser($x){
        $data = array(
			"codcliente" => $this->_session->data->codcliente,
			"usuario"    => $x['email'],
			"pass"       => $this->_general->claveusuario($x['clave1']),
			"nivel"      => "User",
			"nombre"     => $x['nombre'],
			"documento"  => $x['documento'],
			"foto"       => "",
			"fechareg"   => $this->_general->date()->datetime,
			"hash"       => $x['clave1'],
			"estatus"    => "Active",
			"idioma"     => "spanish",
			"estado"     => 1,
        );

        if(!$this->_validPlan()){
            return false;
            exit;
        }

        if(!$this->_validUser(array($data['usuario']))){

            $this->db->trans_begin();
    
            $this->db->insert('usuarios',$data);
    
            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                //$this->setHistorial(array('Nuevo Usuario','Se ha Registrado a '.$data['nombre'].' como administrador del sistema'));
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }

        }else{
            return false;
        }
        
    }//

    private function _validUser($X){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario = ',$X[0]);
        $q = $this->db->get();
        return ($q->num_rows()>=1) ? true : false;
    }//

    private function _validPlan(){
        //Datos del cliente
        $this->db->select('codcliente, plan');
        $this->db->from('clientes');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $q = $this->db->get()->row();

        //Cantidad de Usuarios del Cliente
        $u = $this->db->query("SELECT codcliente FROM usuarios WHERE codcliente = $q->codcliente");
        $t = $u->num_rows();

        //Datos del plan del cliente
        $p = $this->db->query("SELECT * FROM planes WHERE codplan = '$q->plan'");
        $r = $p->row();
        

        return ($t >= $r->limiteplan) ? false : true;
    }//





}//
