<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;

class Mlawyers extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->_email = new Myemail();
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');

        $this->mp = new MP ($this->_conf['prod_client_id'], $this->_conf['prod_client_secret']);
		$this->mpt = new MP ($this->_conf['prod_access_token']);
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
        $this->db->select('idCliente, codcliente, fechareg, tipocliente, plan, nombrefirma, documentofirma, direccionfirma, telefonosfirma, emailfirma, estatus');
        $this->db->from('clientes');
        $this->db->where('codcliente !=','home');
        $g = $this->db->get();
        
        $this->db->select('idCliente, codcliente, fechareg, tipocliente, plan, nombrefirma, documentofirma, direccionfirma, telefonosfirma, emailfirma, estatus');
        $this->db->from('clientes');
        $this->db->where('codcliente !=','home');
        $this->db->where('estatus =','0');
        $s = $this->db->get();
        
        $this->db->select('idCliente, codcliente, fechareg, tipocliente, plan, nombrefirma, documentofirma, direccionfirma, telefonosfirma, emailfirma, estatus');
        $this->db->from('clientes');
        $this->db->where('codcliente !=','home');
        $this->db->where('estatus =','1');
        $a = $this->db->get();
        
        $this->db->select('idCliente, codcliente, fechareg, tipocliente, plan, nombrefirma, documentofirma, direccionfirma, telefonosfirma, emailfirma, estatus');
        $this->db->from('clientes');
        $this->db->where('plan =','demo');
        $d = $this->db->get();

        $data = (object) array(
            "general"   =>  ($g->num_rows()>=1) ? $g->result() : false,
            "activos"   =>  ($a->num_rows()>=1) ? $a->result() : false,
            "inactivos"   =>  ($s->num_rows()>=1) ? $s->result() : false,
            "demos"   =>  ($d->num_rows()>=1) ? $d->result() : false,
        );

        return $data;
    }//

    private function _validData($x){
        switch($x[0]){
            case 'nombre':
                $b = $this->db->query("SELECT nombrefirma FROM clientes WHERE nombrefirma = '$x[1]'");
                return ($b->num_rows()>=1) ? true : false;
            break;
            
            case 'documento':
                $b = $this->db->query("SELECT documentofirma FROM clientes WHERE documentofirma = '$x[1]'");
                return ($b->num_rows()>=1) ? true : false;
            break;
            
            case 'emailfirma':
                $b = $this->db->query("SELECT emailfirma FROM clientes WHERE emailfirma = '$x[1]'");
                return ($b->num_rows()>=1) ? true : false;
            break;
            
            case 'usuario':
                $b = $this->db->query("SELECT usuario FROM usuarios WHERE usuario = '$x[1]'");
                return ($b->num_rows()>=1) ? true : false;
            break;
        }

    }//

    private function _getMessages(){
        $this->db->select('mensajenuevo, mensajeclave');
        $this->db->from('configuracion');
        $q = $this->db->get()->row();
        return $q;
    }//


    public function _newlawyer($x){
        $clave = rand(456789, 123456789);
        $codcli = rand(100,1000).'-'.uniqid();

        $data = array(
			"tipocliente" => $this->security->xss_clean($this->input->post('tipocliente')),
			"nombre"      => $this->security->xss_clean($this->input->post('nombre')),
			"documento"   => $this->security->xss_clean($this->input->post('documento')),
			"usuario"     => $this->security->xss_clean($this->input->post('email')),
			"direccion"   => $this->security->xss_clean($this->input->post('direccion')),
			"telefonos"   => $this->security->xss_clean($this->input->post('telefonos')),
			"plan"        => $this->security->xss_clean($this->input->post('plan')),
        );
        
        if($this->_validData(array('nombre',$data['nombre']))){
            return false;
            exit;
        }
        if($this->_validData(array('documento',$data['documento']))){
            return false;
            exit;
        }
        if($this->_validData(array('emailfirma',$data['usuario']))){
            return false;
            exit;
        }
        
		
		if($data['tipocliente'] =="firma"){

			$data["emailusuario"]     = $this->security->xss_clean($this->input->post('emailusuario'));
			$data["nombreusuario"]    = $this->security->xss_clean($this->input->post('nombreusuario'));
            $data["documentousuario"] = $this->security->xss_clean($this->input->post('documentousuario'));
            
            if($this->_validData(array('usuario',$data['usuario']))){
                return false;
                exit;
            }
			
        };
        
			/*$cli = $this->mpt->post (
				array(
					"uri" => "/v1/customers",
					"data" => array(
						"email" => $x['usuario'],
						"first_name"	=>	$x['nombre'],
						"phone"	=>	array(
							"area_code"	=>	"0241",
							"number"	=>	$x['telefonos']
						),
						"identification"	=>	array(
							"type"	=>	"",
							"number"	=>	$x['documento']
						)
					)
				)
			);*/
        
        $this->db->trans_begin();

        if($x['tipocliente']=="firma"){

            $clin = array(
                'codcliente'     => $codcli,
                'fechareg'       => $this->_general->date()->datetime,
                'tipocliente'    => $x['tipocliente'],
                'plan'           => $x['plan'],
                'nombrefirma'    => strtolower(htmlentities($x['nombre'])),
                'documentofirma' => strtolower(htmlentities($x['documento'])),
                'direccionfirma' => $x['direccion'],
                'telefonosfirma' => $x['telefonos'],
                'emailfirma'     => strtolower(htmlentities($x['usuario'])),
                'fechapago'      => $this->_general->date()->datetime,
                'proximopago'    => $this->_general->date()->datetime,
                'estatus'        => ($x['plan']!='demo') ? '1' : '1',
                'usuarioreg'     => $this->_session->data->nombre,
                'idclientmp'      => '',
                'autmp'           => '',
                'pagoinicial'     => ($x['plan'] == 'demo') ? '1' : '0',
                'afiliacion'      => ($x['plan'] == 'demo') ? '1' : '0',
            );

            $insert = array(
                'codcliente' => $clin['codcliente'],
                'usuario'    => strtolower(htmlentities($x['emailusuario'])),
                'pass'       => $this->_general->claveusuario($clave),
                'nivel'      => 'Client',
                'nombre'     => strtolower(htmlentities($x['nombreusuario'])),
                'documento'  => strtolower(htmlentities($x['documentousuario'])),
                'foto'       => '',
                'fechareg'   => $clin['fechareg'],
                'hash'       => $clave,
                'estatus'    => ($x['plan'] == 'demo') ? 'Active' : 'Inactive',
                'idioma'     => 'spanish',
                'estado'     => '1'
            );
    
            $numeros = array(
                'codcliente'  => $insert['codcliente'],
                'expedientes' => '0',
                'despachados' => '0',
                'pendientes'  => '0',
                'eliminados'  => '0',
                'abogados'    => '1'
            );


        }else{

            $clin = array(
                'codcliente'      => $codcli,
                'fechareg'        => $this->_general->date()->datetime,
                'tipocliente'     => $x['tipocliente'],
                'plan'            => $x['plan'],
                'nombrefirma'     => strtolower(htmlentities($x['nombre'])),
                'documentofirma'  => $x['documento'],
                'direccionfirma'  => $x['direccion'],
                'telefonosfirma'  => $x['telefonos'],
                'emailfirma'      => $x['usuario'],
                'fechapago'       => $this->_general->date()->datetime,
                'proximopago'     => $this->_general->date()->datetime,
                'estatus'         => ($x['plan']!='demo') ? '1' : '1',
                'usuarioreg'      => $this->_session->data->nombre,
                'idclientmp'      => '',
                'autmp'           => '',
                'pagoinicial'     => ($x['plan'] == 'demo') ? '1' : '0',
                'afiliacion'      => ($x['plan'] == 'demo') ? '1' : '0'
            );

            $insert = array(
                'codcliente' => $clin['codcliente'],
                'usuario'    => $x['usuario'],
                'pass'       => $this->_general->claveusuario($clave),
                'nivel'      => 'Client',
                'nombre'     => $x['nombre'],
                'documento'  => $x['documento'],
                'foto'       => '',
                'fechareg'   => $clin['fechareg'],
                'hash'       => $clave,
                'estatus'    => ($x['plan'] == 'demo') ? 'Active' : 'Active',
                'idioma'     => 'spanish',
                'estado'     => '1'
            );
    
            $numeros = array(
                'codcliente'  => $insert['codcliente'],
                'expedientes' => '0',
                'despachados' => '0',
                'pendientes'  => '0',
                'eliminados'  => '0',
                'abogados'    => '1'
            );

        }

        $this->db->set('registroplan','registroplan + 1',false);
        $this->db->where('codplan =',$x['plan']);
        $this->db->update('planes');

        $this->db->insert('clientes',$clin);
        $this->db->insert('usuarios',$insert);
        $this->db->insert('numeros',$numeros);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Nuevo Cliente','Se ha registrado al nuevo Cliente '.$clin['nombrefirma']));

            $msg = $this->_getMessages();
            $nu = $msg->mensajenuevo;
            $nu = str_replace("%name%",ucwords($clin['nombrefirma']),$nu);
            $nu = str_replace("%user%",$insert['usuario'],$nu);
            $nu = str_replace("%pass%",$insert['hash'],$nu);
            $nu = str_replace("%uri%",base_url(),$nu);

            
            $email = $this->_email
                    ->from(['support@trueley.com','Equipo TrueLey','Bienvenido a TrueLey.com'])
                    ->to([$insert['usuario'],$insert['nombre'],$nu,$nu])
                    ->template([TRUE,'newclient.htm'])
                    ->send();

            return true;

        }else{
            $this->db->trans_rollback();
            return false;
        };

    }//


    public function _getPlanes(){
        $this->db->select('*');
        $this->db->from('planes');
        $this->db->where('estatus =','1');
        $q = $this->db->get();

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

}

