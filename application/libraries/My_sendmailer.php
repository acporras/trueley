<?php
/*
Libreria que sirve para configurar envíos de Email a traves de PHPmailer
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use xfxstudios\general\GeneralClass;

class My_sendmailer{

    private $destino = 'info.snapshotla@gmail.com';
    private $receptor = 'Equipo Snapshot';
    protected $ci;

    public function __construct(){
        $this->ci =& get_instance();
        //$this->general = new GeneralClass();
    }

    public function mail(){
        $mail = new PHPMailer(true);
        return $mail;
    }//

    //Envia la clave de usuario registrada
    public function sendNoti($X){

        //Email de Nuevo Usuario
        $mail = $this->mail();
        try {
            $mail->setFrom('mail@mail.com', 'Mail Host');//Remitente
            $mail->addAddress("mailDestino", "nombreDestino");//Destinatario

            //Contenido
            $mail->isHTML(true);

            $mail->AddEmbeddedImage('Image_1.png', 'logo', 'Image_1.png');//solo muestra

            $body = file_get_contents(__DIR__.'/plantillas/plantilla.htm');//solo muestra

            $body = str_replace("%info%", $X['info'], $body);

            $mail->Subject = 'AsuntoMail';
            $mail->Body    = $body;

            $mail->send();
            return "200";
        } catch (Exception $e) {
            return "205";
            //echo 'Error: ' . $mail->ErrorInfo;
        }
    }//


}


?>