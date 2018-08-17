<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_instapago
{
    
    public function __construct(){
        $this->KeyID = "272F7848-326F-4438-B55B-5082B0095BA4";
        $this->PublicKeyId = "ab44318e79aed79e3b1826de9e993a80";
        $this->uri = 'https://api.instapago.com/payment';
    
    }

    public function setNewPay($X){
		$url = $this->uri;

		$X['KeyID']       = $this->KeyID;
		$X['PublicKeyId'] = $this->PublicKeyId;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($X));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);

		$data                    = json_decode($server_output,true);

		$data['message'] = ($data['responsecode']==null) ? $this->getCode(array('responsecode','82')) : $data['message'];
		$data['codeMsg']         = $this->getCode(array('code',$data['code']));
		$data['responsecodeMsg'] = ($data['responsecode']!=null) ? $this->getCode(array('responsecode',$data['responsecode'])) : $this->getCode(array('responsecode','82'));
		$data['typeCard']        = $this->typeCard($X['CardNumber']);

		return $data;
    }//
    
    public function completePay($X){
		$url = $this->uri;

		$X['KeyID']       = $this->KeyID;
		$X['PublicKeyId'] = $this->PublicKeyId;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($X));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);

		return json_decode($server_output,true);
    }//
    
    public function cancelPay($X){
		$url = $this->uri;

		$X['KeyID']       = $this->KeyID;
		$X['PublicKeyId'] = $this->PublicKeyId;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($X));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);

		return json_decode($server_output,true);
    }//
    
    public function searchPay($X){
		$url = $this->uri;

		$X['KeyID']       = $this->KeyID;
		$X['PublicKeyId'] = $this->PublicKeyId;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($X));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);

		return json_decode($server_output,true);
    }//
    
    public function getCode($X){
		switch ($X[0]) {
			case 'responsecode':
				return $this->getResponse($X[1]);
			break;

			case 'code':
				return $this->getErrorCode($X[1]);
			break;
			
		}
    }//
    
    public function getResponse($X){
		$codes = array(
					"00"	=>	"Aprobado",
					"01"	=>	"Llame al Emisor",
					"02"	=>	"Cédula Inválida",
					"03"	=>	"Comercio Inválido",
					"04"	=>	"Retenga y Llame",
					"05"	=>	"Transacción Rechazada",
					"06"	=>	"Error",
					"07"	=>	"Retenga y Llame",
					"12"	=>	"Transacción Inválida",
					"13"	=>	"Monto Inválido",
					"14"	=>	"Tarjeta Inválida",
					"15"	=>	"Emisor Inválido",
					"19"	=>	"Reintente Transacción",
					"21"	=>	"Llame al Emisor",
					"25"	=>	"Registro no Localizado",
					"28"	=>	"Archivo no Disponible",
					"30"	=>	"Error en Formato",
					"39"	=>	"No es Cuenta de Crédito",
					"40"	=>	"Función no Soportada",
					"41"	=>	"Tarjeta Extraviada",
					"43"	=>	"Tarjeta Robada",
					"51"	=>	"Fondo Insuficiente",
					"52"	=>	"No es Cuenta Corriente",
					"53"	=>	"No es Cuenta de Ahorros",
					"54"	=>	"Tarjeta Vencida",
					"55"	=>	"Clave Inválida",
					"57"	=>	"Transacción no Permitida",
					"58"	=>	"Transacción no Permitida",
					"61"	=>	"Excede monto de Retiros",
					"62"	=>	"Tarjeta Restringida",
					"63"	=>	"Falla de Seguridad",
					"65"	=>	"Excede Retiros",
					"68"	=>	"Sin Respuesta del Host",
					"71"	=>	"Excepción Inválida",
					"72"	=>	"Contracargo Inválido",
					"75"	=>	"EXC. Clave Inválida",
					"76"	=>	"Cuenta Inválida",
					"77"	=>	"Cuenta Inválida",
					"78"	=>	"Cuenta Inválida",
					"79"	=>	"Fecha Inválida",
					"80"	=>	"Sistema no Disponible",
					"81"	=>	"Error de Clave",
					"82"	=>	"Tarjeta Inválida",
					"83"	=>	"Codigo de Seguridad inválido",
					"84"	=>	"Autorización Inválida",
					"85"	=>	"No Rechazada",
					"86"	=>	"Clave no Verificada",
					"87"	=>	"Conciliación Detenida",
					"88"	=>	"Totales no Disponibles",
					"89"	=>	"Información no Autorizada",
					"90"	=>	"Servicio Inactivo",
					"91"	=>	"Emisor inactivo",
					"92"	=>	"Servicio no Disponible",
					"93"	=>	"Transacción Incompleta",
					"94"	=>	"Transacción Duplicada",
					"95"	=>	"Enviando Detalles",
					"96"	=>	"Sistema Inactivo",
					"97"	=>	"Sin respuesta del Host",
					"99"	=>	"Rechazada",
				);
		return $codes[$X];
    }//
    
    public function getErrorCode($X){
		$codes = array(
					"201"	=>	"Pago Procesado",
					"400"	=>	"Error al validar Datos Enviados",
					"401"	=>	"Error de autenticación, ha ocurrido un error con las llaves utilizadas",
					"403"	=>	"Pago Rechazado por el Banco",
					"500"	=>	"Ha Ocurrido un error interno dentro del servidor",
					"503"	=>	"Ha Ocurrido un error al procesar los parámetros de entrada. Revise los datos enviados y vuelva a intentarlo",
					);
		return $codes[$X];
    }//
    
    public function typeCard($X){
		$num = $this->clean($X);

		if( substr($num, 0, 1)  == 4 ){
			return "Visa";
		}

		if( substr($num, 0, 2)  == 34 || substr($num, 0, 2)  == 37 ){
			return "American Express";
		}

		if( substr($num, 0, 2)  == 51 || substr($num, 0, 2)  == 54 ){
			return "Master Card";
		}

		if( substr($num, 0, 3)  == 644){
			return "Discover";
		}

		if( substr($num, 0, 4)  == 6011){
			return "Discover";
		}

		if( substr($num, 0, 6)  == 824400){
			return "Sambil";
		}

		if( substr($num, 0, 6)  == 824402){
			return "Rattan";
		}

		if( substr($num, 0, 6)  == 824404){
			return "Locatel";
		}

    }//
    
    public function clean($X){
		$ca = array('|' , ',' , '.' , '-' , '_' , '/' , '(' , ')' , '[' , ']' , ';' , ' ' , '{', '}');
		$X = str_replace($ca,"", $X);
		return $X;
	}//END



}