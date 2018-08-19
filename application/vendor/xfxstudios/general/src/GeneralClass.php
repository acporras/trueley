<?php
namespace xfxstudios\general;

use GeoIp2\Database\Reader;
use xfxstudios\general\GeneralModel;

class GeneralClass
{
    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
		// Instancia de Codeigniter para cargar la libreria mgeneral
		$this->ci =& get_instance();
		$this->genmodel = new GeneralModel();
	}
	
    //detecta el idioma del usuario
	public function idioma(){
	
		if(isset($_SESSION['lang'])){
			$idi = $_SESSION['lang'];
		}
		if(!isset($_SESSION['lang']) && isset($_COOKIE['lang'])){
			$idi = $_COOKIE['lang'];
		}else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			$idi = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		}else{
			$idi = "en";
		}

		return ($idi=='es') ? 'es' : 'en';
	}//

	//Crear variable a partir de cadena de texto simple
	public function _variable($X){
		echo eval('return $'. $X);
	}

	//Retorna los Datos de un usuario desde el CNE con su Cédula de Identidad
	public function limpiarCampo($valor) {
		$rempl = array('\n', '\t');
		$r = trim(str_replace($rempl, ' ', $valor));
		return str_replace("\r", "", str_replace("\n", "", str_replace("\t", "", $r)));
	}//
	public function _verificador($X) {
	
		$n = explode("|",$X);
		if(strlen($n[1])==7){
			$c = "0".$n[1];//Cédulas de 7 Digitos
		}else if(strlen($n[1])==6){
			$c = "00".$n[1];//Cédulas de 6 digitos
		}else{
			$c = $n[1];//Cedula normal
		}
	
			$digitos = str_split($n[0].$c);
			$digitos[8] *= 2;
			$digitos[7] *= 3;
			$digitos[6] *= 4;
			$digitos[5] *= 5;
			$digitos[4] *= 6;
			$digitos[3] *= 7;
			$digitos[2] *= 2;
			$digitos[1] *= 3;
	
			switch ($digitos[0]) {
				case 'V':
					$digitoEspecial = 1;
					break;
				case 'E':
					$digitoEspecial = 2;
					break;
				case 'C':
				case 'J':
					$digitoEspecial = 3;
					break;
				case 'P':
					$digitoEspecial = 4;
					break;
				case 'G':
					$digitoEspecial = 5;
					break;
			}
			$suma = (array_sum($digitos)) + ($digitoEspecial*4);
			$residuo = $suma % 11;
			$resta = 11 - $residuo;
			$digitoVerificador = ($resta >= 10) ? 0 : $resta;
			
		return $digitoVerificador;
	}//
	public function _getUrl($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        if (curl_exec($curl) === false) {
            return false;
        } else {
            $return = curl_exec($curl);
        }
        curl_close($curl);

        return $return;
	}
	public function getCNE($X){
		//Obtenemos el HTML del CNE
			try{
				$context = stream_context_create(array(
					'http' => array(
						'timeout' => 10   // Timeout in seconds
					)
				));
				//$html = $this->_getUrl('http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad='.$X[0].'&cedula='.$X[1]);
				$html = file_get_contents('http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad='.$X[0].'&cedula='.$X[1] , 0 , $context);
				if(!$html){
					throw new Exception("Error ".error_get_last());	
				}
			}catch(Exception $e){
				return $e;
			}
		//Eliminamos las etiquetas HTML
			$html = strip_tags($html);
		//Datos a buscar en el texto generado
			$rempl = array('Cédula:', 'Nombre:', 'Estado:', 'Municipio:', 'Parroquia:', 'Centro:', 'Dirección:', 'SERVICIO ELECTORAL', 'Mesa:');
		//Reemplazamos dichos datos por caracter de control
			$r = trim(str_replace($rempl, '|', $this->limpiarCampo($html)));
		//Gebneramos el array desde el caracter de control
			$recurso = explode("|", $r);
		//Verificamos que el resultado sea válido
			if(strlen($recurso[1])>20){
				//Si no es v´´alido la cédula no existe
				$datos = (object) array(
					"cod"	=>	"201",
					"msg"	=>	"La cédula no se encuentra Registrada o Se envión un dato errado, por favor, verifique"
				);
			}else{
				//Si es válido preparamos el objeto de salida
			$n = explode("-",$recurso[1]);//separamos la cédula
			$nn = explode(" ",$recurso[2]);//Separamos el nombre
			$est = explode(" ",$recurso[3]);
			unset($est[0]);
			$estFinal = (count($est)>1) ? implode(" ",$est) : implode("",$est);
			
			$cid = explode(" ",$recurso[4]);
			unset($cid[0]);
			$cidFinal = (count($cid)>1) ? implode(" ",$cid) : implode("",$cid);
			
			$parr = explode(" ",$recurso[5]);
			unset($parr[0]);
			$parrFinal = (count($parr)>1) ? implode(" ",$parr) : implode("",$parr);


			//$titulos = array('Primer Nombre','Segundo Nombre','Primer Apellido','Segundo Apellido');
		
				$datos = (object) array(
					"cod"            => "200",
					"nacionalidad"   => $n[0],
					"cedula"         => $n[1],
					"RIF"            => (strlen($n[1]) == 7 ) ? $n[0].'-0'.$n[1].'-'.$this->_verificador($n[0].'|'.$n[1]) : $n[0].'-'.$n[1].'-'.$this->_verificador($n[0].'|'.$n[1]),
					"cedCompleta"    => $recurso[1],
					"nombreCompleto" => $recurso[2],
					"estado"         => $estFinal,
					"municipio"      => $cidFinal,
					"parroquia"      => $parrFinal,
					"escuela"        => $recurso[6],
				);
				//Verificamos la cantidad de nombres y apellidos y los recorremos
				/*for($i=0; $i<count($nn);$i++){
					$datos[$titulos[$i]] = $nn[$i];
				}*/
			}
		//Retornamos la respuesta
			return $datos;
	}//

	//Genera una clave de usuario
	function claveusuario($X){
		$salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
		$salt = strtr($salt, array('+' => '.'));
		$hash = crypt($X, '$2y$10$' . $salt);
		$claveB = $hash;
		return $claveB;
	}//END



	//Limpia una cadena de simbolos injnecesarios
	public function eliminar_simbolos($string){
 
        $string = trim($string);
     
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );
     
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                 "#", "@", "|", "!", "\"",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 ".", " "),
            ' ',
            $string
        );
        return $string;
    } 

	//Retorna Informacion completa de una IP
	public function city($X=null){
		$ip = ($X==null) ? $this->IPreal() : $X;
		$reader = new Reader($_SERVER['DOCUMENT_ROOT'].'/application/libraries/GeoLite2-City.mmdb');
		
		try{
			$data = $reader->city($ip);
			
			$out = (object) array(
				'isoCode'   => $data->country->isoCode,
				'nombre'    => $data->country->name,
				'estado'    => $data->mostSpecificSubdivision->name,
				'isoEstado' => $data->mostSpecificSubdivision->isoCode,
				'ciudad'    => $data->city->name,
				'postal'    => $data->postal->code,
				'latitud'   => $data->location->latitude,
				'longitud'  => $data->location->longitude,
				'timezone'  => $data->location->timeZone,
			);
			return $out;
		}catch(Exception $e){
			return $e->getMessage();
		}
    }

	//Retorna Informacion del Pais
    public function country($X=null){
		$ip = ($X==null) ? $this->IPreal() : $X;
		$reader = new Reader($_SERVER['DOCUMENT_ROOT'].'/application/libraries/GeoLite2-Country.mmdb');
		
		try{
			$data = $reader->country($ip);
			$data = json_encode($data);
			$data = json_decode($data,true);

			$out = (object) array(
				'continente'    => $data['continent']['names']['es'],
				'continente_id' => $data['continent']['geoname_id'],
				'pais_id'       => $data['country']['geoname_id'],
				'iso_code'      => $data['country']['iso_code'],
				'pais'          => $data['country']['names']['es']
			);
			return $out;
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	

	//Suma o resta dias a una fecha
	function calfechas($X){
		$timezone = $this->city($this->IPreal())->timezone;
		date_default_timezone_set($timezone);

		if(!is_array($X)){
			return false;
			exit;
		}

		if(!is_numeric($X[2]) || !isset($X[2])){
			return false;
			exit;
		}

		$fecha = $this->date()->date;

		//Si no esta declarada toma la fecha actual
		if($X[0]!=""){
			$f = $X[0];
		}else{
			$f = $fecha;
		}
		//Si no esta reclarada toma el calculo como resta
		if($X[1]=="s"){
			$s="+";
		}else{
			$s="-";
		};


		$nfech = strtotime($s.$X[2].' days', strtotime($f));
		$nfech = date("Y-m-d", $nfech);
		
		return $nfech;
	}
	

	//Retorna la fecha en formato corto
	//Agregadas nuevas formas de fecha
	public function date($time=null,$ip=null){
		setlocale(LC_TIME,$this->idioma());
		
		if($time == null){
			if($ip==null){
				$timezone = $this->city($this->IPreal())->timezone;
			}else{
				$timezone = $this->city($ip)->timezone;
			}
		}else{
			$timezone = $time;
		}
		if($timezone == 'America/Caracas'){
		}else{
			$timezone = 'America/Caracas';
		}
		date_default_timezone_set($timezone);
		$ret = (object) array(
			'datetime'  => date("Y-m-d H:i:s"),
			'date'      => date("Y-m-d"),
			'time'      => date("H:i:s"),
			'microtime' => date("H:i a"),
			'large'     => strftime("%A, %e %B %Y - %H:%M hrs"),
			'extra'     => strftime('%A %e de %B del %Y'),
			'iso'       => date("c"),
			'seconds'   => date("U"),
			'format'    => date("r"),
			'unix'      => time(),
			'timezone'	=>	$timezone
		);
		return $ret;
	}//END


	//Corta el texto agregando 3 puntos al final
	public function cortarTexto($texto, $numMaxCaract){
		if (strlen($texto) <  $numMaxCaract){
			$textoCortado = $texto;
		}else{
			$textoCortado = substr($texto, 0, $numMaxCaract);
			$ultimoEspacio = strripos($textoCortado, " ");
	 
			if ($ultimoEspacio !== false){
				$textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
				if (substr($textoCortado, $ultimoEspacio)){
					$textoCortadoTmp .= '...';
				}
				$textoCortado = $textoCortadoTmp;
			}elseif (substr($texto, $numMaxCaract)){
				$textoCortado .= '...';
			}
		}
	 	return $textoCortado;
	}//END


	//Retorna un codigo alfanumerico aleatorio de 10 digitos exactos
	public function claveUnica($x=null){
			if(!is_numeric($x)){
				return false;
			};

			if(is_array($x)){
				return false;
			};

			if($x==null){ };

	        //Cadena de Letras
	        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	        //Creamos un array con la cadena
	        $lets = str_split($cadena);
	        //Generamos un numero a partir de la fecha y hora del momento
	        $num = strtotime(date("Y-m-d H:i:s"));
	        //Inicializo la variable de prefijo
	        $pref = "";
	        //Indico la cantidad de caracteres a utilizar en el prefijo
	        $l= ($x==null) ? 10 : $x;
	        //Genero el Prefijo
	        for($i=0; $i<$l; $i++){
	            $pref .= $lets[rand($l,(count($lets)-1))];
	        };
	        
	        //Genero la clave
	        $clave = $pref.$num;
	        //Retorno la Clave Generada
	        return $clave;
	}//END


	//Genera un codigo aleatorio basado en una longitud indicada
	public function getCodigo($x){
		if(!is_numeric($x)){
			return false;
		};

		if(is_array($x)){
			return false;
		};

		if($x==null){ $x = 10; };

		$chars = "abcdefghijklmnopqrstuvwxyzABCDRFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$pass = array();
		$alpha = strlen($chars)-1;
		for ($i=0; $i < $x; $i++) {
			$n = rand(0,$alpha);
			$pass[]=$chars[$n];
		}
		return implode($pass);
	}//end


	//Limpia un numero de simbolos no deseados
	public function limpiaNumero($X){
		$ca = array('|' , ',' , '.' , '-' , '_' , '/' , '(' , ')' , '[' , ']' , ';' , ' ' , '{', '}');
		$X = str_replace($ca,"", $X);
		return $X;
	}//END

	//Formatea la fecha con hora
	public function fechalan($X){
		$lan = $this->idioma();
		return $fecha = ($lan == "es") ? date("d-m-Y H:i:s", strtotime($X)) : date("Y-m-d H:i:s", strtotime($X));
	}//END

	//Formatea la fecha sin hora de acuerdo al idioma
	public function fechalanST($X){
		$lan = $this->idioma();
		return $fecha = ($lan == "es") ? date("d-m-Y", strtotime($X)) : date("Y-m-d", strtotime($X));
	}//END


	//Retorna la IP
	public function IPreal() {
		$ip =  "";
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$e = ($ip !="") ? explode(".",$ip) : ['0'];

		$valid = ['0','10','172','192','169','127'];

		return (!in_array($e[0],$valid)) ? $ip : '186.185.186.227';
	}


	//Calcula la Diferencia en Dias entre fechas
	public function diferencia($X){
		$datetime1 = new \DateTime($X[0]);
		$datetime2 = new \DateTime($X[1]);
		$sale = $datetime1->diff($datetime2);

		return $sale->format('%a');
	}//END



	//Calcula la Edad
	public function edad($X){
		$actual = $this->date()->datetime;
		$X      = str_replace("/","-",$X);
		$nace   = date("Y-m-d", strtotime($X));

		$a = $this->diferencia([$actual, $nace]);

		return round(($a / 365),0);
	}//END



	//Formatea un Numero de acuerdo al idioma
	public function numFormat($X){
		switch ($this->idioma()) {
			case 'es':
				$X = number_format($X,2,',','.');
			break;

			case 'en':
				$X = number_format($X,2,'.',',');
			break;
			
			default:
				$X = number_format($X,2,',','.');
			break;
		}
		return $X;
	}//END


	
	//Realiza un explode a los componentes get de una URL
	public function url($X){
		if(isset($X) && $X != ""){
			$host  = explode("?",$X);
			if(isset($host[1])){
				$hostb = explode("&",$host[1]);
			}
			$data  = array();
			if(isset($hostb)){
				foreach ($hostb as $key => $value) {
					$v = explode("=",$value);
					$data[$v[0]] = $v[1];
				}
			}
			return $data;
		}
	}//end



	//Retorna el Dispositivo usado (Ordenador/Tablet/Smartphone)
	public function dispositivo(){

			$tablet_browser = 0;
			$mobile_browser = 0;
			$body_class     = 'desktop';

			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			    $tablet_browser++;
			    $body_class = "tablet";
			}

			if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			    $mobile_browser++;
			    $body_class = "mobile";
			}

			if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			    $mobile_browser++;
			    $body_class = "mobile";
			}

			$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
			$mobile_agents = array(
			    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			    'newt','noki','palm','pana','pant','phil','play','port','prox',
			    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			    'wapr','webc','winw','winw','xda ','xda-');

			if (in_array($mobile_ua,$mobile_agents)) {
			    $mobile_browser++;
			}

			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
			    $mobile_browser++;
			    //Check for tablets on opera mini alternative headers
			    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
			      $tablet_browser++;
			    }
			}
			if ($tablet_browser > 0) {
			// Si es tablet has lo que necesites
			   //print 'es tablet';
			   return 'Tablet';
			}
			else if ($mobile_browser > 0) {
			// Si es dispositivo mobil has lo que necesites
			   //print 'es un mobil';
			   return 'Smartphone';
			}
			else {
			// Si es ordenador de escritorio has lo que necesites
			   //print 'es un ordenador de escritorio'
			   return 'Ordenador';
			}
	}//END


	//Retorna la URL actual
	public function getUrl() {
		$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
		$url .= $_SERVER["REQUEST_URI"];
		return $url;
	  }//end

	  
	//Retorna la imagen gravatar si el usuario la posee
	public function gravatar($mail=null){
		$gravatar_link = 'http://www.gravatar.com/avatar/' . md5($mail) . '?s=32';
		echo $gravatar_link;
	}

	//Genera un Archivo CSV a partir de un array
	function generateCsv($data, $delimiter = ',', $enclosure = '"') {
		$handle = fopen('php://temp', 'r+');
		foreach ($data as $line) {
				fputcsv($handle, $line, $delimiter, $enclosure);
		}
		rewind($handle);
		while (!feof($handle)) {
				$contents .= fread($handle, 8192);
		}
		fclose($handle);
		return $contents;
	 }
	 
	 /**
	 * Rerifica Cuenta de Email, Dominio de una Cuenta dada
	 * Retorna datos en Formato Object
	 */

	public function validEmail($email=null){
		//Iniciamos arreglo de respuesta
		$return = (object) array();

		//Verificamos el formato de Email
		if(valid_email($email)){
			$return->formato = true;
		}else{
			$return->formato = false;
		}

		//Verificamos el Dominio
		$dom = explode("@",$email);
		$r2=checkdnsrr($dom[1], "MX");
		if($r2){
			$return->dominio=true;
		}else{
			$return->dominio=false;
		}

		//Rerificamos que el servidor no este caido
		ini_set("user_agent","Mozilla custom agent");
		$a = @get_headers('http://'.$dom[1],1);
		if (is_array($a) && $a !== FALSE) {
			$return->serverStatus = true;
		} else {
			$return->serverStatus = false;
		}

		return $return;
	}


	/**
	 * Retorna un array de fechas de acuerdo al rango solicitado, excluyendo fines de semana
	*/
	public function diasFin($X){
		$timezone = $this->date()->timezone;
		date_default_timezone_set($timezone);

		$fecha1 = strtotime($X[0]); 
		$fecha2 = strtotime($X[1]); 
		$ret = array();
		for($fecha1;$fecha1<=$fecha2;$fecha1=strtotime('+1 day ' . date('Y-m-d',$fecha1))){ 

			if((strcmp(date('w',$fecha1),'0'))!==0 && (strcmp(date('w',$fecha1),'6'))!==0){
				if($X[2]){
					array_push($ret, date('Y-m-d l',$fecha1)); 
				}else{
					array_push($ret, date('Y-m-d',$fecha1)); 
				}
			}

		}
		return $ret;
	}//


	/**
	 * Retorna un array con los dias habiles en un rango dado
	 * recibe un arra con la data a procesar
	 * array('fecha1','fecha2',array feriados)
	 */
	function diashabiles($X){
		$timezone = $this->city($this->IPreal())->timezone;
		date_default_timezone_set($timezone);

		$inicio = new \DateTime($X[0]);//Inicio
		$final = new \DateTime($X[1]);//Fin

		// Meter fecha final en la operación.
		$final->modify('+1 day');
		
		$intervalo = $final->diff($inicio);
		
		//Días totales
		$dias = $intervalo->days;
		
		// Creamos un perido para que imprima los días (P1D es igual a 1 dia)
		$periodo = new \DatePeriod($inicio, new \DateInterval('P1D'), $final);
		
		//Array con días de fiesta
		$holidays = $X[2];//Array con días de fiesta
	
		foreach($periodo as $d) {
			$pos = $d->format('D');
		
			if ($pos == 'Sat' || $pos == 'Sun') {
				$dias--;
			}
		
			elseif (in_array($d->format('Y-m-d'), $holidays)) {
				$dias--;
			}
		}
		return $dias;
	}//


	//Retorna y Maneja la lista de monedas del sistema
	//Lista de monedas mas comunes
	public function getMonedas($moneda = null){
        
        $data = array(
            "euro"             => (object) array("nombre"=>"Euro","iso"=>"EUR","isocode"=>"978","simboloDerecha"=>"","simboloIzquierda"=>"E","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"euros"),
            "pesoargentino"    => (object) array("nombre"=>"Peso Argentino","iso"=>"ARS","isocode"=>"032","simboloDerecha"=>"","simboloIzquierda"=>"$ ","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"pesos"),
            "dolaraustraliano" => (object) array("nombre"=>"Dólar Australiano","iso"=>"AUD","isocode"=>"036","simboloDerecha"=>"","simboloIzquierda"=>"$","decimales"=>"2","separadordecimal"=>".","separadormiles"=>",","plural"=>"dolares"),
            "boliviano"        => (object) array("nombre"=>"Boliviano","iso"=>"BOB","isocode"=>"068","simboloDerecha"=>"","simboloIzquierda"=>"Bs","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"bolivianos"),
            "dolaramericano"   => (object) array("nombre"=>"Dólar Americano","iso"=>"USD","isocode"=>"840","simboloDerecha"=>"","simboloIzquierda"=>"us$","decimales"=>"2","separadordecimal"=>".","separadormiles"=>",","plural"=>"dolares"),
            "realbrasileño"    => (object) array("nombre"=>"Real Brasileño","iso"=>"BRL","isocode"=>"986","simboloDerecha"=>"","simboloIzquierda"=>"R$","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"reales"),
            "rupiaindia"       => (object) array("nombre"=>"Rupia","iso"=>"INR","isocode"=>"356","simboloDerecha"=>"","simboloIzquierda"=>"Rs","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"rupias"),
            "dolarcanadiense"  => (object) array("nombre"=>"Dólar Canadiense","iso"=>"CAD","isocode"=>"124","simboloDerecha"=>"","simboloIzquierda"=>"$","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"dolares"),
            "pesochileno"      => (object) array("nombre"=>"Peso Chileno","iso"=>"CLP","isocode"=>"152","simboloDerecha"=>"","simboloIzquierda"=>"$","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"pesos"),
            "yuan"             => (object) array("nombre"=>"Yuan","iso"=>"CNY","isocode"=>"156","simboloDerecha"=>"","simboloIzquierda"=>"¥","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"yuanes"),
            "pesocolombiano"   => (object) array("nombre"=>"Peso Colombiano","iso"=>"COP","isocode"=>"170","simboloDerecha"=>"","simboloIzquierda"=>"$ ","decimales"=>"2","separadordecimal"=>"","separadormiles"=>"","plural"=>"pesos"),
            "pesomexicano"     => (object) array("nombre"=>"Peso Mexicano","iso"=>"MXN","isocode"=>"4217","simboloDerecha"=>"","simboloIzquierda"=>"$ ","decimales"=>"2","separadordecimal"=>"","separadormiles"=>"","plural"=>"pesos"),
            "pesocubano"       => (object) array("nombre"=>"Peso Cubano","iso"=>"CUP","isocode"=>"192","simboloDerecha"=>"","simboloIzquierda"=>"$","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"pesos"),
            "libraesterlina"   => (object) array("nombre"=>"Libra Esterlina","iso"=>"GBP","isocode"=>"826","simboloDerecha"=>"","simboloIzquierda"=>"£","decimales"=>"2","separadordecimal"=>".","separadormiles"=>",","plural"=>"libras"),
            "yen"              => (object) array("nombre"=>"Yen","iso"=>"JPY","isocode"=>"392","simboloDerecha"=>"","simboloIzquierda"=>"¥","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"yenes"),
            "sol"              => (object) array("nombre"=>"Sol Peruano","iso"=>"PEN","isocode"=>"604","simboloDerecha"=>"","simboloIzquierda"=>"S/","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"soles"),
            "bolívar"          => (object) array("nombre"=>"Bólivar","iso"=>"VEF","isocode"=>"937","simboloDerecha"=>"Bs.","simboloIzquierda"=>"","decimales"=>"2","separadordecimal"=>",","separadormiles"=>".","plural"=>"bolivares"),
        );

        return ($moneda == null) ? $data : $data[$moneda];
	}
	

	//Retorna una cantidad en letras
	//------    CONVERTIR NUMEROS A LETRAS         ---------------
	//------    Máxima cifra soportada: 18 dígitos con 2 decimales
	//------    999,999,999,999,999,999.99
	// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
	// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
	// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE 99/100 M.N.
	public function numletras($xcifra){
		$xarray = array(0 => "Cero",
			1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
			"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
			"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
			100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
		);

		$xcifra = trim($xcifra);
		$xlength = strlen($xcifra);
		$xpos_punto = strpos($xcifra, ".");
		$xaux_int = $xcifra;
		$xdecimales = "00";
		if (!($xpos_punto === false)) {
			if ($xpos_punto == 0) {
				$xcifra = "0" . $xcifra;
				$xpos_punto = strpos($xcifra, ".");
			}
			$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
			$xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		}

		$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
		$xcadena = "";
		for ($xz = 0; $xz < 3; $xz++) {
			$xaux = substr($XAUX, $xz * 6, 6);
			$xi = 0;
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
					break; // termina el ciclo
				}

				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = $this->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma lógica que las centenas)
							if (substr($xaux, 1, 2) < 10) {
								
							} else {
								$key = (int) substr($xaux, 1, 2);
								if (TRUE === array_key_exists($key, $xarray)) {
									$xseek = $xarray[$key];
									$xsub = $this->subfijo($xaux);
									if (substr($xaux, 1, 2) == 20)
										$xcadena = " " . $xcadena . " VEINTE " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3;
								}
								else {
									$key = (int) substr($xaux, 1, 1) * 10;
									$xseek = $xarray[$key];
									if (20 == substr($xaux, 1, 1) * 10)
										$xcadena = " " . $xcadena . " " . $xseek;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 1, 2) < 10)
							break;
						case 3: // checa las unidades
							if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
								
							} else {
								$key = (int) substr($xaux, 2, 1);
								$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
								$xsub = $this->subfijo($xaux);
								$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
							} // ENDIF (substr($xaux, 2, 1) < 1)
							break;
					} // END SWITCH
				} // END FOR
				$xi = $xi + 3;
			} // ENDDO

			if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
				$xcadena.= " ";

			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
				$xcadena.= " ";

			// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
			if (trim($xaux) != "") {
				switch ($xz) {
					case 0:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN BILLON ";
						else
							$xcadena.= " BILLONES ";
						break;
					case 1:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN MILLON ";
						else
							$xcadena.= " MILLONES ";
						break;
					case 2:
						if ($xcifra < 1) {
							$xcadena = "con CERO $xdecimales/100";
						}
						if ($xcifra >= 1 && $xcifra < 2) {
							$xcadena = "con UN $xdecimales/100";
						}
						if ($xcifra >= 2) {
							$xcadena.= " con $xdecimales/100"; //
						}
						break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
			// ------------------      en este caso, para México se usa esta leyenda     ----------------
			$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("BILLON DE MILLONES", "BILLON ", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES ", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
		} // ENDFOR ($xz)
		return trim($xcadena);
	}

	// END FUNCTION

	public function subfijo($xx)
	{ // esta función regresa un subfijo para la cifra
		$xx = trim($xx);
		$xstrlen = strlen($xx);
		if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
			$xsub = "";
		//
		if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
			$xsub = "MIL";
		//
		return $xsub;
	}


	/**
	 * Retorna la lista de Paises del mundo en formato objeto
	 */
	public function paises(){
		$data =  array(
				 array('id'=>1, 'nombre'=>'Australia'),
				 array('id'=>2, 'nombre'=>'Austria'),
				 array('id'=>3, 'nombre'=>'Azerbaiyán'),
				 array('id'=>4, 'nombre'=>'Anguilla'),
				 array('id'=>5, 'nombre'=>'Argentina'),
				 array('id'=>6, 'nombre'=>'Armenia'),
				 array('id'=>7, 'nombre'=>'Bielorrusia'),
				 array('id'=>8, 'nombre'=>'Belice'),
				 array('id'=>9, 'nombre'=>'Bélgica'),
				 array('id'=>10, 'nombre'=>'Bermudas'),
				 array('id'=>11, 'nombre'=>'Bulgaria'),
				 array('id'=>12, 'nombre'=>'Brasil'),
				 array('id'=>13, 'nombre'=>'Reino Unido'),
				 array('id'=>14, 'nombre'=>'Hungría'),
				 array('id'=>15, 'nombre'=>'Vietnam'),
				 array('id'=>16, 'nombre'=>'Haiti'),
				 array('id'=>17, 'nombre'=>'Guadalupe'),
				 array('id'=>18, 'nombre'=>'Alemania'),
				 array('id'=>19, 'nombre'=>'Países Bajos, Holanda'),
				 array('id'=>20, 'nombre'=>'Grecia'),
				 array('id'=>21, 'nombre'=>'Georgia'),
				 array('id'=>22, 'nombre'=>'Dinamarca'),
				 array('id'=>23, 'nombre'=>'Egipto'),
				 array('id'=>24, 'nombre'=>'Israel'),
				 array('id'=>25, 'nombre'=>'India'),
				 array('id'=>26, 'nombre'=>'Irán'),
				 array('id'=>27, 'nombre'=>'Irlanda'),
				 array('id'=>28, 'nombre'=>'España'),
				 array('id'=>29, 'nombre'=>'Italia'),
				 array('id'=>30, 'nombre'=>'Kazajstán'),
				 array('id'=>31, 'nombre'=>'Camerún'),
				 array('id'=>32, 'nombre'=>'Canadá'),
				 array('id'=>33, 'nombre'=>'Chipre'),
				 array('id'=>34, 'nombre'=>'Kirguistán'),
				 array('id'=>35, 'nombre'=>'China'),
				 array('id'=>36, 'nombre'=>'Costa Rica'),
				 array('id'=>37, 'nombre'=>'Kuwait'),
				 array('id'=>38, 'nombre'=>'Letonia'),
				 array('id'=>39, 'nombre'=>'Libia'),
				 array('id'=>40, 'nombre'=>'Lituania'),
				 array('id'=>41, 'nombre'=>'Luxemburgo'),
				 array('id'=>42, 'nombre'=>'México'),
				 array('id'=>43, 'nombre'=>'Moldavia'),
				 array('id'=>44, 'nombre'=>'Mónaco'),
				 array('id'=>45, 'nombre'=>'Nueva Zelanda'),
				 array('id'=>46, 'nombre'=>'Noruega'),
				 array('id'=>47, 'nombre'=>'Polonia'),
				 array('id'=>48, 'nombre'=>'Portugal'),
				 array('id'=>49, 'nombre'=>'Reunión'),
				 array('id'=>50, 'nombre'=>'Rusia'),
				 array('id'=>51, 'nombre'=>'El Salvador'),
				 array('id'=>52, 'nombre'=>'Eslovaquia'),
				 array('id'=>53, 'nombre'=>'Eslovenia'),
				 array('id'=>54, 'nombre'=>'Surinam'),
				 array('id'=>55, 'nombre'=>'Estados Unidos'),
				 array('id'=>56, 'nombre'=>'Tadjikistan'),
				 array('id'=>57, 'nombre'=>'Turkmenistan'),
				 array('id'=>58, 'nombre'=>'Islas Turcas y Caicos'),
				 array('id'=>59, 'nombre'=>'Turquía'),
				 array('id'=>60, 'nombre'=>'Uganda'),
				 array('id'=>61, 'nombre'=>'Uzbekistán'),
				 array('id'=>62, 'nombre'=>'Ucrania'),
				 array('id'=>63, 'nombre'=>'Finlandia'),
				 array('id'=>64, 'nombre'=>'Francia'),
				 array('id'=>65, 'nombre'=>'República Checa'),
				 array('id'=>66, 'nombre'=>'Suiza'),
				 array('id'=>67, 'nombre'=>'Suecia'),
				 array('id'=>68, 'nombre'=>'Estonia'),
				 array('id'=>69, 'nombre'=>'Corea del Sur'),
				 array('id'=>70, 'nombre'=>'Japón'),
				 array('id'=>71, 'nombre'=>'Croacia'),
				 array('id'=>72, 'nombre'=>'Rumanía'),
				 array('id'=>73, 'nombre'=>'Hong Kong'),
				 array('id'=>74, 'nombre'=>'Indonesia'),
				 array('id'=>75, 'nombre'=>'Jordania'),
				 array('id'=>76, 'nombre'=>'Malasia'),
				 array('id'=>77, 'nombre'=>'Singapur'),
				 array('id'=>78, 'nombre'=>'Taiwan'),
				 array('id'=>79, 'nombre'=>'Bosnia y Herzegovina'),
				 array('id'=>80, 'nombre'=>'Bahamas'),
				 array('id'=>81, 'nombre'=>'Chile'),
				 array('id'=>82, 'nombre'=>'Colombia'),
				 array('id'=>83, 'nombre'=>'Islandia'),
				 array('id'=>84, 'nombre'=>'Corea del Norte'),
				 array('id'=>85, 'nombre'=>'Macedonia'),
				 array('id'=>86, 'nombre'=>'Malta'),
				 array('id'=>87, 'nombre'=>'Pakistán'),
				 array('id'=>88, 'nombre'=>'Papúa-Nueva Guinea'),
				 array('id'=>89, 'nombre'=>'Perú'),
				 array('id'=>90, 'nombre'=>'Filipinas'),
				 array('id'=>91, 'nombre'=>'Arabia Saudita'),
				 array('id'=>92, 'nombre'=>'Tailandia'),
				 array('id'=>93, 'nombre'=>'Emiratos árabes Unidos'),
				 array('id'=>94, 'nombre'=>'Groenlandia'),
				 array('id'=>95, 'nombre'=>'Venezuela'),
				 array('id'=>96, 'nombre'=>'Zimbabwe'),
				 array('id'=>97, 'nombre'=>'Kenia'),
				 array('id'=>98, 'nombre'=>'Algeria'),
				 array('id'=>99, 'nombre'=>'Líbano'),
				 array('id'=>100, 'nombre'=>'Botsuana'),
				 array('id'=>101, 'nombre'=>'Tanzania'),
				 array('id'=>102, 'nombre'=>'Namibia'),
				 array('id'=>103, 'nombre'=>'Ecuador'),
				 array('id'=>104, 'nombre'=>'Marruecos'),
				 array('id'=>105, 'nombre'=>'Ghana'),
				 array('id'=>106, 'nombre'=>'Siria'),
				 array('id'=>107, 'nombre'=>'Nepal'),
				 array('id'=>108, 'nombre'=>'Mauritania'),
				 array('id'=>109, 'nombre'=>'Seychelles'),
				 array('id'=>110, 'nombre'=>'Paraguay'),
				 array('id'=>111, 'nombre'=>'Uruguay'),
				 array('id'=>112, 'nombre'=>'Congo Brazzaville'),
				 array('id'=>113, 'nombre'=>'Cuba'),
				 array('id'=>114, 'nombre'=>'Albania'),
				 array('id'=>115, 'nombre'=>'Nigeria'),
				 array('id'=>116, 'nombre'=>'Zambia'),
				 array('id'=>117, 'nombre'=>'Mozambique'),
				 array('id'=>119, 'nombre'=>'Angola'),
				 array('id'=>120, 'nombre'=>'Sri Lanka'),
				 array('id'=>121, 'nombre'=>'Etiopía'),
				 array('id'=>122, 'nombre'=>'Túnez'),
				 array('id'=>123, 'nombre'=>'Bolivia'),
				 array('id'=>124, 'nombre'=>'Panamá'),
				 array('id'=>125, 'nombre'=>'Malawi'),
				 array('id'=>126, 'nombre'=>'Liechtenstein'),
				 array('id'=>127, 'nombre'=>'Bahrein'),
				 array('id'=>128, 'nombre'=>'Barbados'),
				 array('id'=>130, 'nombre'=>'Chad'),
				 array('id'=>131, 'nombre'=>'Man, Isla de'),
				 array('id'=>132, 'nombre'=>'Jamaica'),
				 array('id'=>133, 'nombre'=>'Malí'),
				 array('id'=>134, 'nombre'=>'Madagascar'),
				 array('id'=>135, 'nombre'=>'Senegal'),
				 array('id'=>136, 'nombre'=>'Togo'),
				 array('id'=>137, 'nombre'=>'Honduras'),
				 array('id'=>138, 'nombre'=>'República Dominicana'),
				 array('id'=>139, 'nombre'=>'Mongolia'),
				 array('id'=>140, 'nombre'=>'Irak'),
				 array('id'=>141, 'nombre'=>'Sudáfrica'),
				 array('id'=>142, 'nombre'=>'Aruba'),
				 array('id'=>143, 'nombre'=>'Gibraltar'),
				 array('id'=>144, 'nombre'=>'Afganistán'),
				 array('id'=>145, 'nombre'=>'Andorra'),
				 array('id'=>147, 'nombre'=>'Antigua y Barbuda'),
				 array('id'=>149, 'nombre'=>'Bangladesh'),
				 array('id'=>151, 'nombre'=>'Benín'),
				 array('id'=>152, 'nombre'=>'Bután'),
				 array('id'=>154, 'nombre'=>'Islas Virgenes Británicas'),
				 array('id'=>155, 'nombre'=>'Brunéi'),
				 array('id'=>156, 'nombre'=>'Burkina Faso'),
				 array('id'=>157, 'nombre'=>'Burundi'),
				 array('id'=>158, 'nombre'=>'Camboya'),
				 array('id'=>159, 'nombre'=>'Cabo Verde'),
				 array('id'=>164, 'nombre'=>'Comores'),
				 array('id'=>165, 'nombre'=>'Congo Kinshasa'),
				 array('id'=>166, 'nombre'=>'Cook, Islas'),
				 array('id'=>168, 'nombre'=>'Costa de Marfil'),
				 array('id'=>169, 'nombre'=>'Djibouti, Yibuti'),
				 array('id'=>171, 'nombre'=>'Timor Oriental'),
				 array('id'=>172, 'nombre'=>'Guinea Ecuatorial'),
				 array('id'=>173, 'nombre'=>'Eritrea'),
				 array('id'=>175, 'nombre'=>'Feroe, Islas'),
				 array('id'=>176, 'nombre'=>'Fiyi'),
				 array('id'=>178, 'nombre'=>'Polinesia Francesa'),
				 array('id'=>180, 'nombre'=>'Gabón'),
				 array('id'=>181, 'nombre'=>'Gambia'),
				 array('id'=>184, 'nombre'=>'Granada'),
				 array('id'=>185, 'nombre'=>'Guatemala'),
				 array('id'=>186, 'nombre'=>'Guernsey'),
				 array('id'=>187, 'nombre'=>'Guinea'),
				 array('id'=>188, 'nombre'=>'Guinea-Bissau'),
				 array('id'=>189, 'nombre'=>'Guyana'),
				 array('id'=>193, 'nombre'=>'Jersey'),
				 array('id'=>195, 'nombre'=>'Kiribati'),
				 array('id'=>196, 'nombre'=>'Laos'),
				 array('id'=>197, 'nombre'=>'Lesotho'),
				 array('id'=>198, 'nombre'=>'Liberia'),
				 array('id'=>200, 'nombre'=>'Maldivas'),
				 array('id'=>201, 'nombre'=>'Martinica'),
				 array('id'=>202, 'nombre'=>'Mauricio'),
				 array('id'=>205, 'nombre'=>'Myanmar'),
				 array('id'=>206, 'nombre'=>'Nauru'),
				 array('id'=>207, 'nombre'=>'Antillas Holandesas'),
				 array('id'=>208, 'nombre'=>'Nueva Caledonia'),
				 array('id'=>209, 'nombre'=>'Nicaragua'),
				 array('id'=>210, 'nombre'=>'Níger'),
				 array('id'=>212, 'nombre'=>'Norfolk Island'),
				 array('id'=>213, 'nombre'=>'Omán'),
				 array('id'=>215, 'nombre'=>'Isla Pitcairn'),
				 array('id'=>216, 'nombre'=>'Qatar'),
				 array('id'=>217, 'nombre'=>'Ruanda'),
				 array('id'=>218, 'nombre'=>'Santa Elena'),
				 array('id'=>219, 'nombre'=>'San Cristobal y Nevis'),
				 array('id'=>220, 'nombre'=>'Santa Lucía'),
				 array('id'=>221, 'nombre'=>'San Pedro y Miquelón'),
				 array('id'=>222, 'nombre'=>'San Vincente y Granadinas'),
				 array('id'=>223, 'nombre'=>'Samoa'),
				 array('id'=>224, 'nombre'=>'San Marino'),
				 array('id'=>225, 'nombre'=>'San Tomé y Príncipe'),
				 array('id'=>226, 'nombre'=>'Serbia y Montenegro'),
				 array('id'=>227, 'nombre'=>'Sierra Leona'),
				 array('id'=>228, 'nombre'=>'Islas Salomón'),
				 array('id'=>229, 'nombre'=>'Somalia'),
				 array('id'=>232, 'nombre'=>'Sudán'),
				 array('id'=>234, 'nombre'=>'Swazilandia'),
				 array('id'=>235, 'nombre'=>'Tokelau'),
				 array('id'=>236, 'nombre'=>'Tonga'),
				 array('id'=>237, 'nombre'=>'Trinidad y Tobago'),
				 array('id'=>239, 'nombre'=>'Tuvalu'),
				 array('id'=>240, 'nombre'=>'Vanuatu'),
				 array('id'=>241, 'nombre'=>'Wallis y Futuna'),
				 array('id'=>242, 'nombre'=>'Sáhara Occidental'),
				 array('id'=>243, 'nombre'=>'Yemen'),
				 array('id'=>246, 'nombre'=>'Puerto Rico')
		);
		return $data;
	}//


	public function paisesb($type=null){
		$json = file_get_contents(__DIR__.'/paises.json');
		if($type==null){
			return json_decode($json);
		}else{
			return $json;
		}
	}



}
