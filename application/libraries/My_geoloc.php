<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

use GeoIp2\Database\Reader;
/*
    Lee la información sobre una IP, el mismo retorna un array
*/

class My_geoloc{


    public function city($X){
        $reader = new Reader(__DIR__.'/GeoLite2-City.mmdb');
        
        $data = $reader->city($X);
        
        $out = (object) array();
            $out['isoCode']   = $data->country->isoCode;
            $out['nombre']    = $data->country->name;
            $out['estado']    = $data->mostSpecificSubdivision->name;
            $out['isoEstado'] = $data->mostSpecificSubdivision->isoCode;
            $out['ciudad']    = $data->city->name;
            $out['postal']    = $data->postal->code;
            $out['latitud']   = $data->location->latitude;
            $out['longitud']  = $data->location->longitude;
        
        return $out;
    }

    public function country($X){
        $reader = new Reader(__DIR__.'/GeoLite2-Country.mmdb');
        
        $data = $reader->country($X);
        $data = json_encode($data);
        $data = json_decode($data,true);

        $out = (object) array();
            $out['continente']    = $data['continent']['names']['es'];
            $out['continente_id'] = $data['continent']['geoname_id'];
            $out['pais_id']       = $data['country']['geoname_id'];
            $out['iso_code']      = $data['country']['iso_code'];
            $out['pais']          = $data['country']['names']['es'];

        return $out;
    }

}
?>