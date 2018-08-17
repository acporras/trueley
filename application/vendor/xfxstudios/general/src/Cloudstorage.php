<?php
namespace xfxstudios\general;
/**
 * Autor: Carlos Quintero 
 * Corporación HITCEL
 * Requiere para su uso 2 Carpetas en la raiz de application en Codeigniter
 * Carpetas: cargas y services
 * Colocar el Archivo de cuentas de servicios json en la carpeta services
 * Ejemplo de carga:
 * ------------------------------------------------
 * use xfxstudios\general\Cloudstorage;
 * 
 * $this->storage = new Cloudstorage(
 *      'Aquí Bucket Google Gloud Storage',
 *      'Aquí Proyecto',
 *      'Aquí nombre de archivo json de servicio'
 * );
 * -------------------------------------------------
 * 
 * requiere de la libreria de Cloud Storage
 * Ejecutar en la raiz de application
 * composer require google/cloud-storage
 * SOLO SI NO SE TIENE INSTALADA
*/

use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Core\Exception\GoogleException;
use xfxstudios\Exception\Storageexception;

class Cloudstorage
{
    private $ci;
    private $bucket;
    private $storage;
    private $ruta;
    private $project;
    private $json;
    private $name;
    private $folder = FALSE;
    private $file;
    private $ext = FALSE;

    public function __construct(){
        $this->ini = parse_ini_file(SYSDIR.'/services/d.ini');
        $this->project = $this->ini['project'];
        $this->json = $this->ini['cjson'];
        $this->storage = new StorageClient([
            'keyFilePath' => SYSDIR.'/'.$this->ini['services'].'/'.$this->json,
            'projectId' => $this->project
        ]);
        $this->bucket = $this->storage->bucket($this->ini['bucket']);

        $this->ci =& get_instance();
        
        $this->ruta = ($this->folder) ? APPPATH."/".$this->folder."/" : APPPATH."/".$this->ini['upload']."/";
    }

    public function nameFile($X=null){
        if($X==null){
            throw new Storageexception("No se ha enviado el Nombre del Archivo",1,array('errorCode'=>'214'));
            exit;
        }
        $this->name = $X;
        return $this;
    }

    public function file($X=null){
        if($X==null){
            throw new Storageexception("No se ha enviado la data del archivo cargado",1,array('errorCode'=>'212'));
            exit;
        }
        if(!is_array($X)){
            throw new Storageexception("La data del Archivo cargado no es un arreglo válido",1,array('errorCode'=>'210'));
            exit;
        }
        if(!file_exists($this->ruta.$this->name)){
            throw new Storageexception("El archivo que intenta descargar, no se encuentra en el Directorio Temporal",1,array('errorCode'=>'208'));
            exit;
        }
        $this->file = json_encode($X);
        $this->ext = strtolower($X['file_ext']);
        return $this;
    }

    public function folder($X=null){
        if($X==null){
            throw new Storageexception("No se ha indicado una Ruta válida",1,array('errorCode'=>'206'));
            exit;
        }
        if(!file_exists(APPPATH.'/'.$X)){
            throw new Storageexception("El directorio indicado no existe",1,array('errorCode'=>'220'));
            exit;
        }
        $this->path = $X;
        return $this;
    }

    public function _extension($X=null){
        $e = ['jpg','jpeg','png','doc','docx','ppt','pptx','xls','xlsx','pdf','mp4'];
        if($X==null){
            throw new Storageexception("No se ha enviado la Extensión del Archivo",1,array('errorCode'=>'222'));
            exit;
        }
        if(!in_array($X,$e)){
            throw new Storageexception("La Extensión enviada no es Válida",1,array('errorCode'=>'224'));
            exit;
        }
        $va = explode(".", $this->name);
        if(!in_array($va[1],$e)){
            throw new Storageexception("La Extensión enviada no coincide con el nombre enviado",1,array('errorCode'=>'226'));
            exit;
        }

        $this->ext = str_replace(".","",$X);
        return $this;

    }

    //carga archivos al bucket seleccionado
    public function _Load(){
        if(!$this->ext){
            throw new Storageexception("No se ha detectado la Extensión del Archivo",1,array('errorCode'=>'204'));
            exit;
        }

        $folder = "";

        switch($this->ext){

            case '.jpg':
            case '.jpeg':
            case '.png':
                $folder = 'images/';
            break;

            case '.doc';
            case '.docx';
            case '.ppt';
            case '.pptx';
            case '.xls';
            case '.xlsx';
            case '.pdf';
                $folder = 'documents/';
            break;

            case '.mp4':
                $folder = 'videos/';
            break;

            default:
                $folder = 'uncategorized/';
            break;

        }

        $options = [
            'resumable'     => true,
            'name'          => $folder.$this->name,
            'predefinedAcl' => 'publicRead'
        ];

            try{
                $object = $this->bucket->upload(
                    fopen($this->ruta.$this->name, 'r'),$options
                );
            }catch(GoogleException $e){
                return $e->getMessage();
            }

            unlink($this->ruta.$this->name);
            if(file_exists($this->ruta.$this->name)){
                throw new Storageexception("Error al intentar eliminar el archivo del directorio",1,array('errorCode'=>'202'));
                exit;
            }
            return "200";
    }

    //Elimina un objeto u archivo
    public function _delFile(){

        switch($this->ext){
            case 'jpg':
            case 'jpeg':
            case 'png':
                $folder = 'images/';
            break;

            case 'doc';
            case 'docx';
            case 'ppt';
            case 'pptx';
            case 'xls';
            case 'xlsx';
            case 'pdf';
                $folder = 'documents/';
            break;

            case 'mp4':
                $folder = 'videos/';
            break;

            default:
                $folder = 'uncategorized/';
            break;
        }

        try{
            $imagen = $this->bucket->object($folder.$this->name);
            $imagen->delete();
        }catch(GoogleException $e){
            return $e->getMessage();
        }

        return "200";
    }

    //Descarga un archivo/imagen del bucket
    public function _downFile(){

        switch($this->ext){
            case 'jpg':
            case 'jpeg':
            case 'png':
                $folder = 'images/';
            break;

            case 'doc';
            case 'docx';
            case 'ppt';
            case 'pptx';
            case 'xls';
            case 'xlsx';
            case 'pdf';
                $folder = 'documents/';
            break;

            case 'mp4':
                $folder = 'videos/';
            break;

            default:
                $folder = 'uncategorized/';
            break;
        }

        $d = APPPATH.'/'.$this->folder.$this->name;
        try{
            $object = $this->bucket->object($folder.$this->name);
            $object->downloadToFile($d);
        }catch(GoogleException $e){
            return $e->getMessage();
        }

        if(file_exists($d)){
            return "200";
        }else{
            throw new Storageexception("Ha ocurrido un error inesperado al intentar descargar el archivo",1,array('errorCode'=>'230'));
            exit;
        }
    }

}

?>