<?php
namespace xfxstudios\general;
/**
 * Modelo de codeigniter para uso con esla libreria
 * copiar a la carpeta models de codeigniter
 */
class GeneralModel
{
    public function __construct(){
        $this->ci =& get_instance();
    }

    public function setHistorial($X){
        return $X;
    }

}