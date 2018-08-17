<?php
use xfxstudios\general\GeneralClass;

class Mgeneral extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->general = new GeneralClass();
    }

    public function setHistorial($X){

    }

}