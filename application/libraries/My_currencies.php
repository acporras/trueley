<?php
/** 
 * Libreria que se conecta con https://openexchangerates.org para retornar diferentes Json de Peticion de COnversion de Monedas
 * Autor: Carlos Quintero
 * Soporta 1000 Peticiones Mensuales
*/
class My_currencies
{
    //URL del servidor node.js quer administra las peticiones de Administracion a firebase
    private $url = 'https://openexchangerates.org/api/';
    private $key = 'f2abbb69af104a08af1c149f9b04907a';


    /**
     * Retorna el Ultimo Json de la Pagina
     * Ejemplo:
     * $this->my_currencies->getJson();
     * Retorna un Objeto
     */
    public function getJson(){
        $ch = curl_init($this->url.'latest.json?app_id='.$this->key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($json);
    }
    
    /**
     * Retorna la Lista de Modenas Soportadas
     * Ejemplo:
     * $this->my_currencies->getCurrencies();
     * Retorna un Objeto con la Lista completa de Monedas Soportadas
     */
    public function getCurrencies(){
        $ch = curl_init($this->url.'currencies.json?app_id='.$this->key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        curl_close($ch);

        return json_decode($json);
    }
    
    /**
     * Retorna la conversión de las monedas para una fecha anterior
     * Ejemplo:
     * $this->my_currencies->getHistory('2017-05-15);
     * Retorna un Objeto
     */
    public function getHistory($date){
        $ch = curl_init($this->url.'historical/'.$date.'.json?app_id='.$this->key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        curl_close($ch);

        return json_decode($json);
    }
    
    
    /**
     * Realiza la conversion de la moneda
     * $this->my_currencies->convert((object)array('ammount'=>1522,'currencieA'=>'USD', 'currencieB'=>'VEF'));
     * Retorna un Objeto con la Conversión
     * No Habilitada en Plan Free
     */
    public function getConvert($X){
        $ch = curl_init($this->url.'convert/'.$X->ammount.'/'.$X->currencieA.'/'.$X->currencieB.'?app_id='.$this->key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        curl_close($ch);

        return json_decode($json);
    }
    
    /**
     * Realiza la conversion de la moneda
     * Ejemplo:
     * $this->my_currencies->usage();
     * Retorna un objeto con la Información del plan y estado de Uso
     */
    public function getUsage(){
        $ch = curl_init($this->url.'usage.json?app_id='.$this->key);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($ch);
        curl_close($ch);

        return json_decode($json);
    }

}
