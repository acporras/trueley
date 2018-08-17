<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    Falta Eliminacion de Datos
    Actualizacion de nodo especifico
    Modo de Uso:    
        $data['firebase'] = $this->firebase->get('V14186540/finanzas/');
		$data['firebase'] = $this->firebase->set( array('V14186540/PRUEBA/',array(
															'Muestra'=>'Esta es una Muestra',
															'Detalle'=>'Este es un Detalle'
														)
													)
												);

		$data['firebase'] = $this->firebase->put( array('V14186540/PRUEBA/', array(
														'Muestra'=>'Esta es una Muestra',
														'Detalle'=>'Este es un Detalle'
													)
												)
											);
		$data['firebase'] = $this->firebase->getKeys('V14186540/historialConexiones/');
*/


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class My_firebase
{
    public function __construct(){
        $this->fire = $this->service();
    }

    //Inicializo el Service para bases de datos
    public function service(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase/snapshot-62081d167c02.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://snapshot-4d614.firebaseio.com')
            ->create();
        
            return $firebase;
    }

    //Inicia la gestion de usuarios en firebase
    public function manager(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebase/snapshot-62081d167c02.json');
        $apiKey = 'AIzaSyCBfkWcY6TuO7FZwFyZ3FeoBdN_qZXPFA0';
        $firebase = (new Factory)
            ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
            ->create();

        $auth = $firebase->getAuth();
        return (object) array('auth'=>$auth,'fire'=>$firebase);
    }


    //Conecta con el nodo de la Base de Datos
    public function reference($X){
        $database = $this->fire->getDatabase();
        $reference = $database->getReference('/snapshot/'.$X);
        return $reference;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente
    public function get($X){
        $snapshot = $this->reference($X)
        ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por la clave
    public function getByKey($X){
        $snapshot = $this->reference($X)
            ->orderByKey()
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por el Valor
    public function getByValue($X){   
        $snapshot = $this->reference($X)
            ->orderByValue()
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico
    public function getByChild($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico Con Limite de retorno al Inicio
    public function getToFirst($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->limitToLast($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


     //Extrae un array con los datos de un nodo determinado ordenados en forma ascendente por un campo especifico Con Limite de retorno al Final
     public function getToLast($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->limitToLast($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro de mayor o igual que
    public function getStartAt($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->startAt($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro de menor o igual que
    public function getEndAt($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->endAt($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }


    //Estrae data de un nodo especificando un campo e indicando un filtro igualdad exacta
    public function getEqualTo($X){   
        $snapshot = $this->reference($X[0])
            ->orderByChild($X[1])
            ->equalTo($X[2])
            ->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    //Retorna un array con los nombres de las claves
    public function getKeys($X){
        $keys = $this->reference($X)  
            ->getChildKeys();

        return $keys;
    }

    //Inserta o Actualiza valores en un Nodo
    public function set($X){
        $set = $this->reference($X[0])
            ->set($X[1]);
        
        return "200";
    }


    //Inserta valores en un nodo y retorna la id de inserción
    public function put($X){
        $set = $this->reference($X[0])
            ->push($X[1]);

        return array('200',$set->getKey());
    }

    public function delete($X){
        $this->reference($X)->remove();
    }

    //**************************************************************************************************************************/
    //Gestion de Usuarios

    //Crear un usuario con Email y Clave
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('email'=>'a@a.com', 'pass'=>'123456');
     * $this->my_firebase->addUser($datos);
     */
    public function addUser($X){
        $user = $this->manager()->auth->createUserWithEmailAndPassword($X->email, $X->pass);
        $userConnection = $this->manager()->fire->asUser($user);
        return $userConnection;
    }

    //datos de un usuario con UID
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'a@a.com');
     * $this->my_firebase->getUser($datos);
     */
    public function getUser($X){
        $user = $this->manager()->auth->getUser($X->uid);

        return $this->manager()->fire->asUser($user);
    }
    
    
    //datos de un usuario con Email y Clave
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('email'=>'a@a.com', 'clave'=>'123456');
     * $this->my_firebase->getUserEmail($datos);
     */
    public function getUserEmail($X){
        $user = $this->manager()->auth->getUserByEmailAndPassword($X->email, $X->clave);

        return $this->manager()->fire->asUser($user);
    }
    
    
    //Cambiar Clave de usuario
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'XXXXXXXXX', 'clave'=>'123456');
     * $this->my_firebase->newPass($datos);
     */
    public function newPass($X){
        $user = $this->manager()->auth->getUser($X->uid);
        $update = $this->manager()->auth->changeUserPassword($user, $X->clave);

        return $update;
    }
    
    
    //Cambiar Email de Usuario
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'XXXXXXXX', 'email'=>'ab@a.com');
     * $this->my_firebase->newEmail($datos);
     */
    public function newEmail($X){
        $user = $this->manager()->auth->getUser($X->uid);
        $update = $this->manager()->auth->changeUserEmail($user, $X->email);

        return $update;
    }
    
    
    //Eliminar un Usuario
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'XXXXXXXX');
     * $this->my_firebase->delUser($datos);
     */
    public function delUser($X){
        $user = $this->manager()->auth->getUser($X->uid);
        $delete = $this->manager()->auth->deleteUser($user);

        return $delete;
    }
    
    
    //Enviar Verificación de Email
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'XXXXXXXX');
     * $this->my_firebase->verEmail($datos);
     */
    public function verEmail($X){
        $user = $this->manager()->auth->getUser($X->uid);
        $send = $this->manager()->auth->sendEmailVerification($user);

        return $send;
    }
    
    
    //Reset Password Email
    /**
     * Recibe objeto como parametro
     * $datos = (object) array('uid'=>'XXXXXXXX');
     * $this->my_firebase->resetEmail($datos);
     */
    public function resetEmail($X){
        $user = $this->manager()->auth->getUser($X->uid);
        $send = $this->manager()->auth->sendPasswordResetEmail($user);

        return $send;
    }

    //end Gestion de Usuarios
    //**************************************************************************************************************************/
   
}
