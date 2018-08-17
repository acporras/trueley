<?php
namespace xfxstudios\general;
/**
 * Autor: Carlos Quintero 
 * Corporación HITCEL
 * Requiere para su uso del archivo d.ini de la carpeta services
 * Ejemplo de carga:
 * ------------------------------------------------
 * use xfxstudios\general\Valid;
 * $this->valid = new Valid();
 * -------------------------------------------------
 * 
 * requiere de la libreria de Firebase JWT
 * Ejecutar en la raiz de application
 * composer require firebase/php-jwt
 * SOLO SI NO SE TIENE INSTALADA o IMPLEMENTADA
 * 
 * Funciones
 * _SignIn -> Genera el Tocken con la Data que recibe en formato array
 * _Check -> Valida la integridad del tocken
 * _GetData -> Retorna la data almacenada en el Tocken
 * _Aud -> Genera una cadena codificada con la informacion del servidor
*/

use Firebase\JWT\JWT;
use xfxstudios\general\GeneralClass;

class Valid
   
    {
        private $ci;
        private $_secret_key;
        private $_encrypt;
        private $_aud = null;

        public function __construct(){
            $this->ci =& get_instance();
            $this->ini = parse_ini_file(SYSDIR.'/services/d.ini');
            $this->_secret_key = $this->ini['secret_key'];
            $this->_encrypt = [$this->ini['encrypt']];
            $this->gen = new GeneralClass();
        }//
        
        public function _SignIn($data=null)
        {
            if($data==null){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid or empty data supplied."
                );
                return $err;
            }
            if(!is_array($data)){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid data format supplied."
                );
                return $err;
            }

            $time = $this->gen->date()->unix;
            
            $token = array(
                'iat'   => $time,
                'exp'   => $time + (60*60*$this->ini['hours']),
                'error' => false,
                'aud'   => $this->_Aud(),
                'data'  => $data
            );

            try{
                $encode =  JWT::encode($token, $this->_secret_key);
                return $encode;
            }catch(\Exception $e){
                $err = (object) array(
                    'error'   => true,
                    'message' => $e->getMessage()
                );
                return $err;
            }
    
        }//


        public function _SignInRemote($data=null)
        {
            if($data==null){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid or empty data supplied."
                );
                return $err;
            }
            if(!is_array($data)){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid data format supplied."
                );
                return $err;
            }

            $time = $this->gen->date()->unix;
            
            $token = array(
                'iat'    => $time,
                'exp'    => $time + (60*60*$this->ini['hours']),
                'error'  => false,
                'aud'    => $this->_Aud(),
                'remote' => true,
                'data'   => $data
            );

            try{
                $encode =  JWT::encode($token, $this->_secret_key);
                return $encode;
            }catch(\Exception $e){
                $err = (object) array(
                    'error'   => true,
                    'message' => $e->getMessage()
                );
                return $err;
            }
    
        }//


        
        public function _Check($token=null)
        {
            if($token==null){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid token supplied."
                );
                return $err;
            }
            if(empty($token))
            {
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid token supplied."
                );
                return $err;
            }
            try{

                $decode = JWT::decode(
                    $token,
                    $this->_secret_key,
                    $this->_encrypt
                );
                
                if($decode->aud !== $this->_Aud())
                {
                    $err = (object) array(
                        'error'   => true,
                        'message' => "Invalid user logged in."
                    );
                    return $err;
                }

                return $decode;

            }catch(\Exception $e){
                $err = (object) array(
                    'error'   => true,
                    'message' => $e->getMessage()
                );
                return $err;
            }
        }//



        public function _CheckRemote($token=null)
        {
            if($token==null){
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid token supplied."
                );
                return $err;
            }
            if(empty($token))
            {
                $err = (object) array(
                    'error'   => true,
                    'message' => "Invalid token supplied."
                );
                return $err;
            }
            try{

                $decode = JWT::decode(
                    $token,
                    $this->_secret_key,
                    $this->_encrypt
        );

                return $decode;

            }catch(\Exception $e){
                $err = (object) array(
                    'error'   => true,
                    'message' => $e->getMessage()
                );
                return $err;
            }
        }//


        
        public function _GetData($token=null)
        {
            if($token==null){
                return false;
            }

            if($this->_Check($token)->error){
                return $this->_Check($token);
            }
            try{
                $info =  JWT::decode(
                    $token,
                    $this->_secret_key,
                    $this->_encrypt
                );
                return $info;

            }catch(\Exception $e){
                $err = (object) array(
                    'error'   => true,
                    'message' => $e->getMessage()
                );
                return $err;
            }
        }//

        private function _Aud()
        {
            $aud = '';
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $aud = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $aud = $_SERVER['REMOTE_ADDR'];
            }
            
            $aud .= @$_SERVER['HTTP_USER_AGENT'];
            $aud .= gethostname();
            
            return sha1($aud);
        }//
    }
