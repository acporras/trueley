<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Madmins extends CI_model
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

    public function _getLista(){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('codcliente =','home');
        $this->db->where('nivel !=','Webmaster');
        $q = $this->db->get();

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

    private function _validUser($X){
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario = ',$X[0]);
        $q = $this->db->get();
        return ($q->num_rows()>=1) ? true : false;
    }//

    private function _getUserdata($x){
        $a = $this->db->query("SELECT * FROM usuarios WHERE idUsuario = '$x'");
        return ($a->num_rows()>=1) ? $a->row() : false;
    }//

    public function _newAdmin($x){
        $data = array(
			"codcliente" => "home",
			"usuario"    => $x['email'],
			"pass"       => $this->_general->claveusuario($x['clave1']),
			"nivel"      => "Admin",
			"nombre"     => $x['nombre'],
			"documento"  => $x['documento'],
			"foto"       => "",
			"fechareg"   => $this->_general->date()->datetime,
			"hash"       => $x['clave1'],
			"estatus"    => "Active",
			"idioma"     => "spanish",
			"estado"     => 1,
        );

        if(!$this->_validUser(array($data['usuario']))){

            $this->db->trans_begin();
    
            $this->db->insert('usuarios',$data);
    
            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                $this->setHistorial(array('Nuevo Administrador','Se ha Registrado a '.$data['nombre'].' como administrador del sistema'));
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }

        }else{
            return false;
        }
        
    }//


    public function _estatus($x){

        $this->db->trans_begin();
        
        switch($x['tipo']){
            case 'suspender':

                $this->db->set('estatus','Inactive');
                $this->db->set('estado','0');
                $this->db->where('idUsuario =',$x['id']);
                $this->db->update('usuarios');

                if($this->db->trans_complete()===TRUE){
                    $this->db->trans_commit();
                    $this->setHistorial(array('Suspensión de Administrador','Se ha suspendido a '.$this->_getUserdata($x['id'])->nombre.' de la administración del sistema.' ));
                    return true;
                }else{
                    $this->db->trans_rollback();
                    return false;
                }
            break;
            
            case 'activar':

                $this->db->set('estatus','Active');
                $this->db->set('estado','1');
                $this->db->where('idUsuario =',$x['id']);
                $this->db->update('usuarios');

                if($this->db->trans_complete()===TRUE){
                    $this->db->trans_commit();
                    $this->setHistorial(array('Activación de Administrador','Se ha reactivado a '.$this->_getUserdata($x['id'])->nombre.' en la administración del sistema.' ));
                    return true;
                }else{
                    $this->db->trans_rollback();
                    return false;
                }
            break;
            
            case 'eliminar':
                $this->db->select('*');
                $this->db->from('usuarios');
                $this->db->where('usuario =',$this->_session->data->usuario);
                $r = $this->db->get()->row();

                if(password_verify($x['clave'], $r->pass)){
                
                    $this->setHistorial(array('Eliminación de Administrador','Se ha eliminado a '.$this->_getUserdata($x["id"])->nombre.' del sistema.' ));

                    $this->db->where('idUsuario =',$x['id']);
                    $this->db->delete('usuarios');

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
            break;

            default:
                return false;
            break;
        }
    }//

    public function _cambioclave($x){

        $this->db->trans_begin();

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario =',$this->_session->data->usuario);
        $r = $this->db->get()->row();

        if(password_verify($x['anterior'], $r->pass)){
        
            $clave = $x['clave1'];
            $hash = $this->_general->claveUsuario($x['clave1']);

            $this->db->set('pass',$hash);
            $this->db->set('hash',$clave);
            $this->db->where('usuario =',$this->_session->data->usuario);
            $this->db->update('usuarios');

            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                $this->setHistorial(array('Modificación de Clave','Se ha modificado la clave a '.$r->nombre));
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }

        }else{
            return false;
        }

    }//


    public function _edit($x){
        $data = array(
			"usuario"   => $x['usuario'],
			"nombre"    => $x['nombre'],
			"documento" => $x['documento']
        );
        
        $this->db->set('usuario',$x['usuario']);
        $this->db->set('nombre',$x['nombre']);
        $this->db->set('documento',$x['documento']);
        $this->db->where('idUsuario =',$x['id']);

        $this->db->trans_begin();
        
        $this->db->update('usuarios');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Edición de Administrador','Se han modificado los datos de '.$x['nombre']));
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//


    


}
