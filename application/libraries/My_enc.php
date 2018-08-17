<?php

class My_enc
{
    public function __construct(){

    }

    function encrypt_url($string) {
        $_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $CI =& get_instance();
        $output = false;
        
        $secret_key = $_conf['encryption_key'];
        $secret_iv = $_conf['iv'];
        $encrypt_method = $_conf['encryption_mechanism'];
        
        $key = hash('sha256', $secret_key);
        
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
       
        $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($result);
        return $output;
        
    }

    function decrypt_url($string) {
        $_conf = parse_ini_file(SYSDIR.'/services/conf.ini');
        $CI =& get_instance();
        
        $output = false;
        
        $security = $_conf;
        $secret_key = $security['encryption_key'];
        $secret_iv = $security['iv'];
        $encrypt_method = $security['encryption_mechanism'];
        
         $key = hash('sha256', $secret_key);
        
         $iv = substr(hash('sha256', $secret_iv), 0, 16);
               
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
}
