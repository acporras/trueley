<?php
/** 
 * Libreria que se encarga de peticiones desde el area de administrador para gestionar usuarios de firebase
 * Autor: Carlos Quintero
 * Servidor NODE.JS para API en heroku.com
*/
class My_api_firebase
{
    //URL del servidor node.js quer administra las peticiones de Administracion a firebase
    private $url = 'https://hitcel.herokuapp.com/';


    //Registra un Usuario en Firebase a Través de la API
    public function addUser($X){
            $service_url = $this->url."addUser/".$X->usuario."/".$X->movil."/".$X->hash."/".str_replace(" ","%20",$X->nombre);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_POST           => true,
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
    }//


    /**
     * Retorna la información de un usuario de firebase
     * Recibe el Email como Parametro
     * Retorna un Objeto
     */
    public function getUser($X){
            $service_url = $this->url."getUser/".$X->email;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'GET',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
    }//
    
    
    /**
     * Actualiza el Nombre y Movil de un usuario
     * Recibe el uid, movil, nombre
     * Toodos los parametros son obligatorios
     * Formato de movil +58XXXXXXXXX (es decir debe incluir el codigo país)  
     * Retorna un Objeto
     */
    public function setNamePhone($X){
            $service_url = $this->url."updateUserUid/".$X->uid."/".$X->movil."/".str_replace(" ","%20",$X->nombre);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//


    /**
     * Actualzia el Email del Usuario de Firebase
     * NOTA: Esta funcion debe utilizarse actualizando de igual manera el usuario en la base de datos local
     * en caso contrario falla el login de dicho usuario
     * Recibe UID y el Email como Parametro
     * Retorna un Objeto
     */
    public function setEmail($X){
            $service_url = $this->url."updateUserEmail/".$X->uid."/".$X->email;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Valida una cuenta de Email en Firebase
     * Recibe UID
     * Retorna un Objeto
     */
    public function validateEmail($X){
            $service_url = $this->url."validateUserEmail/".$X->uid;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Actualiza la foto del Usuario en Firebase
     * Recibe UID y URL de la Nueva Foto
     * NOTA: Debe realizarse la actualizacióin tambien en modo local del Usuario
     * Retorna un Objeto
     */
    public function updatePhoto($X){
            $service_url = $this->url."updateUserPhoto/".$X->uid."/".urlencode($X->foto);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Actualiza la Clave del Usuario en Firebase
     * NOTA: Debe realizarse la actualizacióin tambien en modo local del Usuario
     * en caso contrario tendra problemas para el login al sistema
     * Recibe UID y Clave nueva del usuario
     * Retorna un Objeto
     */
    public function updatePass($X){
            $service_url = $this->url."updateUserPass/".$X->uid."/".urlencode($X->clave);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Suspende un usuario en Firebase
     * NOTA: Una ves suspendido el sistema no permite el ingreso a gmanager
     * Recibe UID
     * Retorna un Objeto
     */
    public function suspendUser($X){
            $service_url = $this->url."suspendUser/".$X->uid;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Reactiva un usuario suspendido previamente
     * Recibe UID
     * Retorna un Objeto
     */
    public function activateUser($X){
            $service_url = $this->url."activateUser/".$X->uid;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'PUT',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

    /**
     * Elimina un Usuario de Firebase
     * NOTA: Si elimina un usuario de firebase, este no poodra ingresar nuevamente al sistema
     * Recibe UID
     * Retorna un Objeto
     */
    public function deleteUser($X){
            $service_url = $this->url."deleteUser/".$X->uid;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $service_url,
                CURLOPT_CUSTOMREQUEST   =>  'DELETE',
                CURLOPT_HEADER         => true,
                CURLOPT_CONNECTTIMEOUT => 120,
                CURLOPT_TIMEOUT        => 120
            ));
            $resp = curl_exec($curl);
            if(!curl_exec($curl)){
                return 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
            }
            curl_close($curl);
            $data = explode("vegur",$resp);
            return json_decode($data[1]);
            return $resp;
    }//

}
