<?php
/**
 * Libreria para la generacion de condigos UUID
 */
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class My_uuid
{
    /**
     * Retorta un codigo basado en la fecha y hora de la solicitud
     * $this->my_uuid->timeBased();
     * i.e. e4eaaaf2-d142-11e1-b3e4-080027620cdd
     */
    public function timeBased(){
        try{
            $uuid1 = Uuid::uuid1();
            return $uuid1->toString();

        }catch(UnsatisfiedDependencyException $e){
            return 'Caught exception: ' . $e->getMessage();
        };
    }

    /**
     * Retorna un codigo basado en el NameSpace
     * $this->my_uuid->namedBased('cadena');
     * i.e. e4eaaaf2-d142-11e1-b3e4-080027620cdd
     */
    public function namedBased($name=null){
        try{
            $X = ($name==null) ? uniqid().'hitcel': $name;
            $uuid5 = Uuid::uuid3(Uuid::NAMESPACE_DNS, $X);
        }catch(UnsatisfiedDependencyException $e){
            return 'Caught exception: ' . $e->getMessage();
        };
    }
    
    /**
     * Retorna un codigo de tipo aleatoreo
     * $this->my_uuid->random();
     * i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
     */
    public function random(){
        try{
            $uuid4 = Uuid::uuid4();
            return $uuid4->toString();
        }catch(UnsatisfiedDependencyException $e){
            return 'Caught exception: ' . $e->getMessage();
        };
    }
    
    /**
     * Retorna un c´dogio basado en una cadena pasada
     * $this->my_uuid->namedMD('nombre');
     * i.e. c4a760a8-dbcf-5254-a0d9-6a4474bd1b62
     */
    public function namedMD($name=null){
        try{
            $con = rand(999999,99999999999);
            $X = ($name==null) ? 'hitcel-'.$con: $name;

            $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $name);
            return $uuid5->toString();
        }catch(UnsatisfiedDependencyException $e){
            return 'Caught exception: ' . $e->getMessage();
        };
    }
}
