<?php

use GuzzleHttp\Client;
use xfxstudios\general\Valid;
class Juzgados
{
    public function __construct(){
        $this->ci =& get_instance();
        $this->_client = new Client([
            'base_uri' => 'http://www.jusmisiones.gov.ar/consultas_online/forms/expedientes/listado.php'
        ]);
        $this->_valid   = new Valid();
		$this->_session = $this->_valid->_Check($this->ci->session->token);
    }
    public function _getCircunscirpciones(){
        $data = array(
            array('1','Primera circunscripción'),
            array('2','Segunda circunscripción'),
            array('3','Tercera circunscripción'),
            array('4','Cuarta circunscripción'),
        );
        return $data;
    }//

    public function _getLocalidad($x){

        $data = array(
            '1' =>  array(
                array('22','CERRO AZUL'),
                array('6','GARUPA'),
                array('2','LEANDRO N. ALEM'),
                array('1','POSADAS'),
            ),
            '2' =>  array(
                array('13','ARIST. DEL VALLE'),
                array('5','OBERA'),
                array('14','SAN VICENTE'),
            ),
            '3' =>  array(
                array('9','ELDORADO'),
                array('30','PTO. IGUAZU'),
            ),
            '4' =>  array(
                array('7','CAPIOVI'),
                array('11','JARDIN AMERICA'),
                array('10','PUERTO RICO'),
            ),
        );

        return $data[$x];

    }//

    public function _getJuzgados($x,$y){
        $data = array(
            '1' =>  array(
                '22'    =>  array(
                    array('97','JUZG.DE PAZ -C.AZUL-'),
                ),
                '6'    =>  array(
                    array('10021','JUZGADO DE PAZ DE FÁTIMA - Garupá'),
                    array('103','JUZG.DE PAZ - GARUPA-'),
                ),
                '2'    =>  array(
                    array('90','JUZG.DE PAZ -L.N.ALEM-'),
                    array('64','Juzgado Civil y Comercial, Laboral y de Familia - L.N. ALEM'),
                ),
                '1'    =>  array(
                    array('10018','Juzgado de Paz de Itaembe Mini'),
                    array('87','Juzgado de Paz en lo Civil y Comercial Nro. 1'),
                    array('88','Juzgado de Paz en lo Civil y Comercial Nro. 2'),
                    array('86','Juzgado de Paz en lo Contravencional'),
                    array('5','SECRETARIA JUDICIAL - S.T.J.'),
                    array('99120','TRIBUNAL PENAL Nro 2-PDAS'),
                    array('56','Juzgado de Familia Nro. 1'),
                    array('57','Juzgado de Familia Nro. 2'),
                    array('10032','JUZGADO de VIOLENCIA FAMILIAR N° 1'),
                    array('74','Juzgado Laboral Nro. 1'),
                    array('75','Juzgado Laboral Nro. 2'),
                    array('76','Juzgado Laboral Nro. 3'),
                    array('77','Juzgado Laboral Nro. 4'),
                    array('48','Juzgado Civil y Comercial Nro. 1'),
                    array('49','Juzgado Civil y Comercial Nro. 2'),
                    array('50','Juzgado Civil y Comercial Nro. 3'),
                    array('51','Juzgado Civil y Comercial Nro. 4'),
                    array('52','Juzgado Civil y Comercial Nro. 5'),
                    array('53','Juzgado Civil y Comercial Nro. 6'),
                    array('54','Juzgado Civil y Comercial Nro. 7'),
                    array('55','Juzgado Civil y Comercial Nro. 8'),
                    array('78','Registro Público de Comercio'),
                    array('70','Secretaría de Ejecución Tributaria - Juzg. Civil Nro. 1'),
                    array('71','Secretaría de Ejecución Tributaria - Juzg. Civil Nro. 4'),
                    array('10011','Secretaría de Ejecución Tributaria - Juzg. Civil Nro. 7'),
                    array('72','Secretaría de Ejecución Tributaria - Juzg. Civil Nro. 8 '),
                ),
            ),
            '2' =>  array(
                '12'    =>  array(
                    array('512','JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle')
                ),
                '5'    =>  array(
                    array('121','Juzgado de Familia Nro. 1 - OBERA'),
                    array('120','Juzgado Laboral Nro. 1 - OBERA'),
                    array('115','Juzgado Civil y Comercial Nro. 1 - OBERA'),
                    array('116','Juzgado Civil y Comercial Nro. 2 - OBERA'),
                    array('117','Juzgado Civil y Comercial Nro. 3 - OBERA'),
                    array('142','Juzgado de Paz - OBERA'),
                ),
                '14'    =>  array(
                    array('314','JUZGADO 1RA INSTANCIA EN LO CIVIL, COMERCIAL, LABORAL Y DE FAMILIA Nº 1'),
                    array('154','JUZG.DE PAZ -S.VICENTE-'),
                ),
                '13'    =>  array(
                    array('512','JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle'),
                ),
            ),
            '3' =>  array(
                '9' =>  array(
                    array('188','JUZG.DE PAZ -ELDORADO-'),
                    array('167','Juzgado de Familia Nro. 1 - ELDORADO'),
                    array('169','Juzgado Laboral Nro. 1 - ELDORADO'),
                    array('170','Juzgado Laboral Nro. 2 - ELDORADO'),
                    array('160','Juzgado Civil y Comercial Nro. 1 - ELDORADO'),
                    array('161','Juzgado Civil y Comercial Nro. 2 - ELDORADO'),
                ),
                '30'    =>  array(
                    array('191','JUZG.DE PAZ -PTO.IGUAZU-'),
                    array('162','Juzgado Civil y Comercial, Laboral y de Familia - IGUAZU'),
                ),
            ),
            '4' =>  array(
                '7' =>  array(
                    array('215','JUZG.DE PAZ -CAPIOVI-'),
                ),
                '11' =>  array(
                    array('202','Juzgado Civil y Comercial, Laboral y de Familia - JARDIN AMERICA'),
                ),
                '10' =>  array(
                    array('528','JUZGADO DE FAMILIA Y VIOLENCIA FAMILIAR Nº 1'),
                    array('201','Juzgado Civil, Comercial y Laboral - PUERTO RICO'),
                    array('214','JUZG.DE PAZ -PTO.RICO-'),
                ),
            ),
        );

        return $data[$x][$y];
    }//


    public function _getCaseFile($x){
		//79371/2018
		try{
			$response = $this->_client->request('POST', '', [
				'form_params' => [
                    'nro_expte'   => $x['expediente'],
                    'dependencia' => $x['juzgado'],
				]
			]);

			$control = fopen(__DIR__."/consultas/consulta".$this->_session->data->usuario.".html","w+");
			fwrite($control, $response->getBody()->getContents());
			fclose($control);

			return $this->_getFileData();

		}catch(Exception $e){
			//En caso de error
			//return $e->getMessage();
			return false;
		}
    }//
    


    private function _getFileData(){
		$dom = new domDocument; 
		$f = __DIR__."/consultas/consulta".$this->_session->data->usuario.".html";
		$file = file_get_contents($f);

			$dom->loadHTML($file);
			$dom->preserveWhiteSpace = false; 
			$tables = $dom->getElementsByTagName('table'); 
			$rows = $tables->item(0)->getElementsByTagName('tr');
			
			if($rows->length==2){
				$fil = $rows->item(1)->getElementsByTagName('td');
				$data = (object) array(
					'cod'  => '200',
					'expediente'  => $fil->item(0)->nodeValue,
					'caratula'    => $fil->item(1)->nodeValue,
					'despacho'    => $fil->item(2)->nodeValue,
					'dependencia' => $fil->item(3)->nodeValue,
					'localidad'   => $fil->item(4)->nodeValue,
				);
				unlink($f);
				return $data;

			}else if($rows->length >2){
				$fil = $rows->item( $rows->length -1 )->getElementsByTagName('td');
				$data = (object) array(
                    'cod'  => '200',
					'expediente'  => $fil->item(0)->nodeValue,
					'caratula'    => $fil->item(1)->nodeValue,
					'despacho'    => $fil->item(2)->nodeValue,
				    'dependencia' => $fil->item(3)->nodeValue,
					'localidad'   => $fil->item(4)->nodeValue,
				);
				unlink($f);
				return $data;

			}else if($rows->length == 1){
				unlink($f);
				return false;
			}
			

	}//





}


?>