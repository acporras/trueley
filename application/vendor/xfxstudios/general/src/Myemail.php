<?php
namespace xfxstudios\general;

use \Mailjet\Resources;
use xfxstudios\Exception\Emailexception;

class Myemail
{
    private $apiKey;
    private $apiSecret;
    private $forMail;
    private $forName;
    private $fromMail;
    private $fromName;
    private $subject;
    private $template = FALSE;
    private $templateName;
    private $info;
    private $plainText;
    private $copy = FALSE;
    private $copyMail;
    private $copyName;
    private $hiddenCopy = FALSE;
    private $hiddenCopyMail;
    private $hiddenCopName;
    private $attachment = FALSE;
    private $cType;
    private $fileName;
    private $codeFile;
    private $errno = FALSE;
    private $setvariables = FALSE;
    private $varcontent;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ini = parse_ini_file(SYSDIR.'/services/d.ini');
        $this->apiKey = $this->ini['keyMail'];
        $this->apiSecret = $this->ini['secretMail'];
        $this->mj = new \Mailjet\Client($this->apiKey, $this->apiSecret,true,['version' => $this->ini['versionMail']]);
    }

    public function from($X=null){
        if($X==null){
            throw new Emailexception("No se han enviado parámetros de Envío", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos Enviados no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<3){
            throw new Emailexception("Faltan Parámetros de envío", 1);
            exit;
        }
        if(empty($X[0])){
            throw new Emailexception("Falta el Email destinatario", 1);
            exit;
        }
        if(empty($X[1])){
            throw new Emailexception("Falta el Nombre del Destinatario", 1);
            exit;
        }
        if(empty($X[2])){
            throw new Emailexception("Falta el Asunto del Email", 1);
            exit;
        }
        $this->fromMail     = $X[0];
        $this->fromName = $X[1];
        $this->subject  = $X[2];
        return $this;
    }

    public function to($X=null){
        if(empty($this->fromMail) || empty($this->fromName) || empty($this->subject)){
            throw new Emailexception("Faltan o están incompletos los Parámetros de Envío", 1);
            exit;
        }
        if($X==null){
            throw new Emailexception("Faltán parámetros del Receptor", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos del receptor no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<4){
            throw new Emailexception("Faltán parámetros del Receptor", 1);
            exit;
        }
        if(empty($X[0])){
            throw new Emailexception("Falta el Email del Receptor", 1);
            exit;
        }
        if(empty($X[1])){
            throw new Emailexception("Falta el nombre del Receptor del Email", 1);
            exit;
        }
        if(empty($X[2])){
            throw new Emailexception("Falta la Información a ser enviada en el Email", 1);
            exit;
        }
        if(empty($X[3])){
            throw new Emailexception("Falta la información en texto plano", 1);
            exit;
        }
        $this->forMail   = $X[0];
        $this->forName   = $X[1];
        $this->info      = $X[2];
        $this->plainText = $X[3];
        return $this;
    }

    public function variables($x=null){
        if($x[0]){
            $this->setvariables = true;
            $this->varcontent = json_encode($x[1]);
            return $this;
        }
    }//

    public function copy($X=null){
        if($X==null){
            throw new Emailexception("Faltán parámetros de la Copia", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos de copia no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<3){
            throw new Emailexception("Faltán parámetros de la Copia", 1);
            exit;
        }
        if($X[0] && empty($X[1])){
            throw new Emailexception("Falta el Email del receptor de la Copia", 1);
            exit;
        }
        if($X[0] && empty($X[2])){
            throw new Emailexception("Falta el Nombre del receptor de la Copia", 1);
            exit;
        }
        $this->copy     = $X[0];
        $this->copyMail = $X[1];
        $this->copyName = $X[2];
        return $this;
    }
    
    public function hiddenCopy($X=null){
        if($X==null){
            throw new Emailexception("Faltán parámetros de la Copia Oculta", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos de copia oculta no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<3){
            throw new Emailexception("Faltán parámetros de la Copia Oculta", 1);
            exit;
        }
        if($X[0] && empty($X[1])){
            throw new Emailexception("Falta el Email del receptor de la Copia Oculta", 1);
            exit;
        }
        if($X[0] && empty($X[2])){
            throw new Emailexception("Falta el Nombre del receptor de la Copia Oculta", 1);
            exit;
        }
        $this->hiddenCopy     = $X[0];
        $this->hiddenCopyMail = $X[1];
        $this->hiddenCopyName = $X[2];
        return $this;
    }

    public function template($X=null){
        if($X==null){
            throw new Emailexception("Faltán parámetros de la Plantilla", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos de la Plantilla no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<2){
            throw new Emailexception("Faltán parámetros de la Plantilla", 1);
            exit;
        }
        if($X[0] && empty($X[1])){
            throw new Emailexception("Falta el Nombre del Archivo HTMl/HTM de la Plantilla", 1);
            exit;
        }
        $this->template     = $X[0];
        $this->templateName = $X[1];
        return $this;
    }
    
    public function attachFile($X=null){
        if($X==null){
            throw new Emailexception("Faltán parámetros del Adjunto", 1);
            exit;
        }
        if(!is_array($X)){
            throw new Emailexception("Los datos del adjunto no son un arreglo válido", 1);
            exit;
        }
        if(count($X)<4){
            throw new Emailexception("Faltán parámetros del Adjunto", 1);
            exit;
        }
        if($X[0] && empty($X[1])){
            throw new Emailexception("Falta el Tipo de Adjunto a Enviar", 1);
            exit;
        }
        if($X[0] && empty($X[2])){
            throw new Emailexception("Falta el nuevo Nombre del Adjunto a Enviar", 1);
            exit;
        }
        if($X[0] && empty($X[3])){
            throw new Emailexception("Falta la Codificación Base64 del Archivo a Enviar", 1);
            exit;
        }
        $this->attachment = $X[0];
        $this->cType       = $this->contentType($X[1]);
        $this->fileName    = $X[2];
        $this->codeFile    = $X[3];
        return $this;
    }
    

    private function contentType($X){
        switch ($X) {
            case 'jpg':
            case 'jpeg':
                return 'image/jpeg';
            break;
            
            case 'png':
                return 'image/png';
            break;
            
            case 'doc':
                return 'application/msword';
            break;
            
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            break;
            
            case 'pdf':
                return 'application/pdf';
            break;
            
            case 'ppt':
                return 'application/vnd.ms-powerpoint';
            break;
            
            case 'pptx':
                return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
            break;
            
            case 'xls':
                return 'application/vnd.ms-excel';
            break;
            
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            break;
            
            case 'json':
                return 'application/json';
            break;
            
            case 'csv':
                return 'text/csv';
            break;

            default:
                throw new Emailexception("El tipo de Archivo a Enviar, no se encuentra registrado", 1);
                exit;
            break;
        }

    }

    private function armed(){
        $data = [];
        $data['From'] = [
            'Email'=>$this->fromMail,
            'Name'=>$this->fromName
        ];
        $data['To'] = [
            [
                'Email'=>$this->forMail,
                'Name'=>$this->forName
            ]
        ];
        if($this->copy){
            $data['Cc'] = [
                [
                    'Email'=>$this->copyMail,
                    'Name'=>$this->copyName
                ]
            ];
        }
        if($this->hiddenCopy){
            $data['Bcc'] = [
                [
                    'Email'=>$this->hiddenCopyMail,
                    'Name'=>$this->hiddenCopyName
                ]
            ];
        }
        return $data;
    }

    public function send(){
        if(empty($this->fromMail) || empty($this->fromName) || empty($this->subject)){
            throw new Emailexception("Faltan o están incompletos los Parámetros de Envío", 1);
            exit;
        }
        if(empty($this->forMail) || empty($this->forName) || empty($this->info) || empty($this->plainText)){
            throw new Emailexception("Faltan o están incompletos los Parámetros del Receptor del Envío", 1);
            exit;
        }
        $data = null;
        if($this->template){
            if(file_exists(APPPATH.'/plantillas/'.$this->templateName)){
                $file = file_get_contents(APPPATH.'/plantillas/'.$this->templateName);
                if($file===FALSE){
                    throw new Emailexception("No se ha podido recuperar el archivo ".$this->templateName, 1);
                    exit;
                }
                $file = str_replace("%info%",$this->info,$file);
                $data = $file;
            }else{
                $this->errno = TRUE;
            }
        }else{
            $data = $this->info;
        }

        $datos = $this->armed();
        $datos['Subject'] = $this->subject;
        $datos['TextPart'] = $this->plainText;
        $datos['HTMLPart'] = $data;

        if($this->attachment){
            $datos['Attachments'] = [
                [
                    'ContentType'   => $this->cType,
                    'Filename'      => $this->fileName,
                    'Base64Content' => $this->codeFile
                ]
            ];
        }

        if($this->setvariables){
            $vars = json_decode($this->varcontent);
            $datos['TemplateLanguage']  = true;
            $datos['Variables'] = [];
            foreach($vars as $key => $value){
                $datos['Variables'][$key]   =  $value;
            }
        }

        $body = [
            'Messages' => [
                $datos
            ]
        ];
        
        if(!$this->errno){
            $response = $this->mj->post(Resources::$Email, ['body' => $body]);
            return $response->getData();
        }else{
            return false;
        }
    }//

}