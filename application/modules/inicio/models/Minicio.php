<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;

class Minicio extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_email = new Myemail();
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $this->_valid   = new Valid();
    }

    public function _newAccount($x){
        if($this->_validEmail($x['email'])){
            return "301";
            exit;
        }
       
        if($this->_validDocumento($x['documento'])){
            return "302";
            exit;
        }

        $clave = rand(456789, 123456789);
        $codcli = rand(100,1000).'-'.uniqid();

        $this->db->trans_begin();

        $clin = array(
            'codcliente'     => $codcli,
            'fechareg'       => $this->_general->date()->datetime,
            'tipocliente'    => 'individual',
            'plan'           => $x['codigo'],
            'nombrefirma'    => strtolower(htmlentities($x['nombre'])),
            'documentofirma' => strtolower(htmlentities($x['documento'])),
            'direccionfirma' => $x['direccion'],
            'telefonosfirma' => $x['telefonos'],
            'emailfirma'     => strtolower(htmlentities($x['email'])),
            'fechapago'      => $this->_general->date()->datetime,
            'proximopago'    => $this->_general->date()->datetime,
            'estatus'        => '0',
            'usuarioreg'     => 'Auto Registro',
            'idclientmp'     => '',
            'autmp'          => '',
            'pagoinicial'    => '0',
            'afiliacion'     => '0'
        );

        $insert = array(
            'codcliente' => $clin['codcliente'],
            'usuario'    => strtolower(htmlentities($x['email'])),
            'pass'       => $this->_general->claveusuario($clave),
            'nivel'      => 'Client',
            'nombre'     => strtolower(htmlentities($x['nombre'])),
            'documento'  => strtolower(htmlentities($x['documento'])),
            'foto'       => '',
            'fechareg'   => $clin['fechareg'],
            'hash'       => $clave,
            'estatus'    => 'Inactive',
            'idioma'     => 'spanish',
            'estado'     => '0'
        );

        $numeros = array(
            'codcliente'  => $insert['codcliente'],
            'expedientes' => '0',
            'despachados' => '0',
            'pendientes'  => '0',
            'eliminados'  => '0',
            'abogados'    => '1'
        );

        $this->db->insert('clientes',$clin);
        $this->db->insert('usuarios',$insert);
        $this->db->insert('numeros',$numeros);

        $novedadb = array(
            'fecha'	=>	$this->_general->date()->datetime,
            'para'	=>	'Admin',
            'tipo'	=>	'register',
            'info'	=>	'Se ha registrado un nuevo Cliente: '.$clin['nombrefirma'].', Documento: '.$clin['documentofirma']
        );
        $this->db->insert('novedades',$novedadb);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();

            $pa = "<p>Estimado(a) <b>".$clin['nombrefirma']."</b>, le damos la mas cordial bienvenida a Trueley.com, la plataforma innovadora que le permitirá a usted y su equipo gestionar de manera más eficientes sus expedientes. <br></p>
            <p>La siguiente información le brindará acceso a su cuenta:</p>
            <p>
                <ul>
                    <li>Usuario: <b>".$insert['usuario']."</b></li>
                    <li>Clave: <b>".$clave."</b></li>
                </ul>
            </p>
            <p>De igualmanera le invitamos a hacer clic en el siguiente enlace para activar su cuenta y continuar con el proceso:</p><br><hr>
            <p><center><a href='".base_url()."inicio/activateaccount?codcliente={{var:codcliente:\"\"}}&user={{var:user:\"\"}}'>Activar Cuenta</a></center></p><hr>";

            $email = $this->_email
                ->from(['support@trueley.com','Equipo TrueLey','Bienvenido a Trueley'])
                ->to([$x['email'],$x['nombre'],$pa,$pa])
                ->template([TRUE,'newreg.htm'])
                ->variables([TRUE,['codcliente'=>$codcli,'user'=>$insert['usuario']]])
                ->send();

            return "200";

        }else{
            $this->db->trans_rollback();
            return "400";
        };

    }//

    private function _validEmail($x){
        $a = $this->db->query("SELECT emailfirma FROM clientes WHERE emailfirma = '$x'");
        if($a->num_rows()>=1){
            return true;
        }
        
        $b = $this->db->query("SELECT usuario FROM usuarios WHERE usuario = '$x'");
        if($b->num_rows()>=1){
            return true;
        }

        return false;
    }//
    
    private function _validDocumento($x){
        $a = $this->db->query("SELECT documentofirma FROM clientes WHERE documentofirma = '$x'");
        if($a->num_rows()>=1){
            return true;
        }
        
        $b = $this->db->query("SELECT documento FROM usuarios WHERE documento = '$x'");
        if($b->num_rows()>=1){
            return true;
        }

        return false;
    }//

    public function _getPlanes(){
        $q = $this->db->query("SELECT * FROM planes WHERE codplan !='demo'");
        return ($q->num_rows()>=1) ? $q->result() : false;
    }//
    
    public function _getPoliticas(){
        $q = $this->db->query("SELECT politicas FROM configuracion");
        return ($q->num_rows() >= 1) ? $q->row() : false;
    }//


    public function _restore($x){

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario =',$x);
        $q = $this->db->get();

        if($q->num_rows()<=0){
            return false;
        }

        $r = $q->row();

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
        return true;
    }//


    private function _shaValid()
    {
        $sha = $this->_conf['sharemoto'];
        $sha .= $this->_general->date('America/Caracas')->date;
        
        return hash('ripemd160',sha1($sha));
    }//

    private function _getMessages(){
        $this->db->select('mensajenuevo, mensajeclave');
        $this->db->from('configuracion');
        $q = $this->db->get()->row();
        return $q;
    }//


}
