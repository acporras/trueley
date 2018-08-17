<?php

//use Google\Cloud\Storage\StorageClient;
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
use xfxstudios\general\Myemail;

class Mlogin extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->general = new GeneralClass();
        $this->_valid = new Valid();
        $this->_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $this->_email = new Myemail();
    }

    //Recibe la data desde Login -> signinUser()
    public function ingresar($X){
        $this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('usuario =',$X->usuario);
		$this->db->where('estado =','1');

        $res = $this->db->get();
        
        if($res->num_rows() == 1){
            $r = $res->row();
            $password  = ( crypt($X->clave, $r->pass) );

            if($r->estado != "1"){
                return false;
            }

            if(password_verify($X->clave, $r->pass)){

                $cli = $this->_getCLiente($r->codcliente);
                
                if($r->nivel == "User"){
                    return false;
                };

                if($r->nivel != "Admin"){

                    if($cli){

                        $datos = array(
                            'codcliente'  => $r->codcliente,//Required
                            'usuario'     => $r->usuario,//Required
                            'nombre'      => $r->nombre,//Required
                            'documento'   => $r->documento,//Required
                            'idioma'      => $r->idioma,//Required
                            'foto'        => $r->foto,//Required
                            'nivel'       => $r->nivel,//Required
                            'acceso'      => $this->general->date('America/Caracas')->datetime,//Required
                            'token'       => false,//Required
                            'tipocliente' => $cli->tipocliente,
                            'cliente'     => $cli,
                            'plan'        => $this->_getPlandata($cli->plan),
                            'fechapago'   => $cli->fechapago,
                            'proximopago' => $cli->proximopago,
                            'app'         => 'Iscusapp',//Required
                            'uri'         => 'http://iscus.oo',//Required
                            'sha'         => $this->_shaValid()//Required
                        );
                    
                        $token = $this->_valid->_SignIn($datos);
                        
                    
                        $info = array('token' =>  $token);
                        $this->session->set_userdata($info);
                        
                        if($X->recordar){
                            $user_enc       = $this->encryption->encrypt($X->usuario);
                            $pass_enc       = $this->encryption->encrypt($X->clave);
                            $rec_enc        = $this->encryption->encrypt("recordar");
                            setcookie('uenc',$user_enc,time()+31556926,'/');
                            setcookie('penc',$pass_enc,time()+31556926,'/');
                            setcookie('renc',$rec_enc,time()+31556926,'/');
                        }
                        return true;
                    
                    }else{
                        return false;
                    }

                };

                if($r->nivel =="Admin" || $r->nivel =="Webmaster"){
                    //Login Admin
                    $datos = array(
                        'codcliente'  => $r->codcliente,//Required
                        'usuario'     => $r->usuario,//Required
                        'nombre'      => $r->nombre,//Required
                        'documento'   => $r->documento,//Required
                        'idioma'      => $r->idioma,//Required
                        'foto'        => $r->foto,//Required
                        'nivel'       => $r->nivel,//Required
                        'acceso'      => $this->general->date('America/Caracas')->datetime,//Required
                        'token'       => false,//Required
                        'app'         => 'Iscusapp',//Required
                        'uri'         => 'http://iscus.oo',//Required
                        'sha'         => $this->_shaValid()//Required
                    );
                    
                    $token = $this->_valid->_SignIn($datos);

                    $info = array('token' =>  $token);
                    $this->session->set_userdata($info);
                    
                    if($X->recordar){
                        $user_enc       = $this->encryption->encrypt($X->usuario);
                        $pass_enc       = $this->encryption->encrypt($X->clave);
                        $rec_enc        = $this->encryption->encrypt("recordar");
                        setcookie('uenc',$user_enc,time()+31556926,'/');
                        setcookie('penc',$pass_enc,time()+31556926,'/');
                        setcookie('renc',$rec_enc,time()+31556926,'/');
                    }
                    return true;
                }


            }else{
                return false;
            }
        }else{
            return false;
        }
    }//


    //Genera un sha único diario para validacion de accesos remotos
    private function _shaValid()
    {
        $sha = $this->_conf['sharemoto'];
        $sha .= $this->general->date('America/Caracas')->date;
        
        return hash('ripemd160',sha1($sha));
    }//

    private function _getPlandata($x){
        $a = $this->db->query("SELECT codplan, nombreplan, limiteplan, costodolar, costopeso, estatus FROM planes WHERE codplan = '$x'");
        return ($a->num_rows()>=1) ? $a->row() : false;
    }//

    private function _getCliente($x){
        $this->db->select('*');
        $this->db->from('clientes');
        $this->db->where('codcliente =',$x);

        $q = $this->db->get();
        if($q->num_rows()==1){
            return $q->row();
        }else{
            return false;
        }
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

        $cod = 'rec-'.uniqid().'-'.$this->general->date()->unix;

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
            'fecha'   => $this->general->date()->datetime,
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

    private function _getMessages(){
        $this->db->select('mensajenuevo, mensajeclave');
        $this->db->from('configuracion');
        $q = $this->db->get()->row();
        return $q;
    }//

}

?>