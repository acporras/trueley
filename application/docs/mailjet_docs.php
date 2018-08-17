<h1>Uso de Libreria Myemail</h1>
<p>La libreria <b>Myemail</b> Es utilizada para Realizar el Envio de Emails mediante <b>MailJet</b>.</p>

<h3>Modo de Implementarla</h3>
<p>Para Implementar la libreria en el Controlador o modelo donde se requiera su uso, se debe realizar los siguiente:</p>

<pre><code class="language-php">
    use xfxstudios\general\Myemail;

    public function __construct(){
        $this->_email = new Myemail();
    }

</code></pre>


<p>Debe configurarse el archivo <b>d.ini</b> para agregar las keys de la api</p>
<pre><code class="languange-php">
    [MailjetKeys]
    keyMail = apiKey
    secretMail = secretKey
    versionMail = v3.1

</code></pre>

<p>La libreria puede enviar Emails con Cuerpo HTML y plano, asi como copia y Copia Oculta,, cuenta con un costructor para el Envio de Emails</p>

<h3>Constructor</h3>
<p>El MailBuilder de la Librería se encarga de preparar y realizar el envío del Email</p>

<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->Copy([TRUE,'accounreceive@domain.com','Receive Name'])
                    ->hiddenCopy([TRUE,'accounreceive@domain.com','Receive Name'])
                    ->attachFile([TRUE,'Document type','Documento Name',base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/path/documentName'))])
                    ->template([TRUE,'template.htm'])
                    ->send()

</code></pre>

<p>Las opciones del Builder son opcionales, a excepci{on de <code>from, for, send</code> las cuales son necesarias para el procesamiento del Email</p>

<h3>Envío Simple</h3>

<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->send()
    //respuesta:
    array(1) { 
        ["Messages"]=> array(1) { 
            [0]=> array(5) { 
                ["Status"]=> string(7) "success" 
                ["CustomID"]=> string(0) "" 
                ["To"]=> array(1) { 
                    [0]=> array(4) { 
                        ["Email"]=> string(20) "receive@domain.com" 
                        ["MessageUUID"]=> string(36) "33e28940-7ce6-4906-905b-872446e5d23f" 
                        ["MessageID"]=> int(70368744369802254) 
                        ["MessageHref"]=> string(57) "https://api.mailjet.com/v3/REST/message/70368744369802254" 
                    } 
                } 
                ["Cc"]=> array(0) { } 
                ["Bcc"]=> array(0) { } 
            } 
        } 
    } 

</code></pre>
<p>La Respuesta Puede ser Procesada o datos de esta almacenados en una db para su posterior procesamiento si se requiere</p>


<h3>Envío Con Copia (Cc)</h3>

<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->Copy([TRUE,'accounreceive@domain.com','Receive Name'])
                    ->send()
    //respuesta:
    array(1) { 
        ["Messages"]=> array(1) { 
            [0]=> array(5) { 
                ["Status"]=> string(7) "success" 
                ["CustomID"]=> string(0) "" 
                ["To"]=> array(1) { 
                    [0]=> array(4) { 
                        ["Email"]=> string(20) "direccion@hitcel.com" 
                        ["MessageUUID"]=> string(36) "1ba29a0c-ad86-4242-9193-baafa9bfcf4a" 
                        ["MessageID"]=> int(70650219347898681) 
                        ["MessageHref"]=> string(57) "https://api.mailjet.com/v3/REST/message/70650219347898681" 
                    } 
                } 
                ["Cc"]=> array(1) { 
                    [0]=> array(4) { 
                        ["Email"]=> string(24) "info.fxstudios@gmail.com" 
                        ["MessageUUID"]=> string(36) "dc88b0cb-ec9b-45a4-b9a3-14903a43f827" 
                        ["MessageID"]=> int(70650219347898682) 
                        ["MessageHref"]=> string(57) "https://api.mailjet.com/v3/REST/message/70650219347898682" 
                    }
                } 
                ["Bcc"]=> array(0) { } 
            } 
        } 
    } 

</code></pre>

<h3>Envío Con Copia Oculta (Bcc)</h3>

<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->hiddenCopy([TRUE,'accounreceive@domain.com','Receive Name'])
                    ->send()
    //respuesta:
    array(1) { 
        ["Messages"]=> array(1) { 
            [0]=> array(5) { 
                ["Status"]=> string(7) "success" 
                ["CustomID"]=> string(0) "" 
                ["To"]=> array(1) { 
                    [0]=> array(4) { 
                        ["Email"]=> string(20) "direccion@hitcel.com" 
                        ["MessageUUID"]=> string(36) "e77eab15-50be-478b-aa6e-cb3b4fbf4720" 
                        ["MessageID"]=> int(70368744369805306) 
                        ["MessageHref"]=> string(57) "https://api.mailjet.com/v3/REST/message/70368744369805306" 
                    } 
                } 
                ["Cc"]=> array(0) { } 
                ["Bcc"]=> array(1) { 
                    [0]=> array(4) { 
                        ["Email"]=> string(29) "carlosquintero14624@gmail.com" 
                        ["MessageUUID"]=> string(36) "00444e42-0e2a-4b4c-b461-ebec7856ccf1" 
                        ["MessageID"]=> int(70368744369805307) 
                        ["MessageHref"]=> string(57) "https://api.mailjet.com/v3/REST/message/70368744369805307" 
                    } 
                } 
            } 
        } 
    } 

</code></pre>


<h3>Envío Con Template</h3>
<p>Se puede utilizar templates de Emails para el envío, estos deben estar almacenados en la carpeta <code>plantillas</code> en <code>application</code> de <b>CI</b></p>
<p>Se pasa como parametro un <b>Booleanos</b> indicando que esta activa la opcion de template y el nombre de la plantilla a utilizar.</p>
<p><code>IMPORTANTE:</code> Si se van a enviar imagenes incrustadas, estas deben estar almacenadas en la nube, de lo contrario no se van a anexar</p>


<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->template([TRUE,'template.htm'])
                    ->send()
    //respuesta:
    La respuesta es igual a las anteriores de acuerdo a la combibnacion realziada

</code></pre>


<p>Las plantillas deben contener como parametro <code>%info%</code>, este parametro es reemplazado por la información a enviar al usuario, la cual debe ser procesada antes de enviar el email, por ejemplo</p>

<pre><code class="language-php">
    $cadena = "Los nombres de los usuarios son:";
    $datos = [
        ['nombre'=>'Maria'],
        ['nombre'=>'José'],
        ['nombre'=>'Ramón'],
        ['nombre'=>'Moises'],
        ['nombre'=>'Carlos'],
    ];
    foreach($datos as $item){
        $cadena .= "&#60;li>".$item['nombre']."&#60;/li>";
    };

    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain.com','Receive Name',$cadena,'Actualice su visor de Email para ver el contenido enviado'])
                    ->template([TRUE,'template.htm'])
                    ->send()
    //respuesta:
    De esta manera estamos enviado una cadena HTML a la plantilla la cual recibira la info com se espera

</code></pre>
<p>Muestra de la Plantilla con la data procesada</p>
<img src="<?php echo $url; ?>assets/images/muestra.png"/>


<h3>Envío Multiple</h3>
<p>Para un envío multiple, se deben agregar la data a un array un procesarla con un foreach</p>

<pre><code class="language-php">
    $datos = [
        ['nombre'=>'Maria','email'=>'email@domain.com'],
        ['nombre'=>'José','email'=>'email@domain.com'],
        ['nombre'=>'Ramón','email'=>'email@domain.com'],
        ['nombre'=>'Moises','email'=>'email@domain.com'],
        ['nombre'=>'Carlos','email'=>'email@domain.com'],
    ];
    $respuestas = array();
    foreach($datos as $item){
        array_push($respuestas, $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for([$item['email'] ,$item['nombre'],'Info a enviar','Actualice su visor de Email para ver el contenido enviado'])
                    ->template([TRUE,'template.htm'])
                    ->send()
        );
    };

    //Como ven almacenamos las respuestas de cada envío para su posterior procesamiento

</code></pre>


<h3>Envío con Archivo Adjunto</h3>
<p>Se puede enviar solo 1 archivo adjunto cuyo peso no sea mayor a los <code>15MB</code></p>
<p>Al igual que en casos anteriores el archivo debe estar en un directorio temporal del sistema antes de ser enviado he igualmente debe ser codificado a <code>Base64</code> antes de su envío</p>

<p>Parametros:</p>
<p><code>->attachFile([TRUE,'<b>Tipo de Archivo</b>','<b>Nuevo Nombre del Archivo</b>',base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/ruta/<b>Nombre del Archivo a Cargar</b>'))])</code></p>

<pre><code class="language-php">
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['account@domain.com','Receive name','Send Info','Plain Text'])
                    ->attachFile([TRUE,'docx','documento.docx',base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/documento.docx'))])
                    ->template([TRUE,'test.htm'])
                    ->send()

</code></pre>
<p>Los Tipos de Archivos soportados son:</p>
<ul>
    <li>jpg / jpeg</li>
    <li>png</li>
    <li>doc / docx</li>
    <li>xls / xlsx</li>
    <li>ppt / pptx</li>
    <li>pdf</li>
    <li>json</li>
    <li>csv</li>
</ul>

<p><code>INFO: </code> Si un archivo se encuentra en el Bucket, debe ser descargado con la librería <b>Storage</b> a una carpeta temporal antes de su codificación</p>
<img src="<?php echo $url; ?>assets/images/muestrab.png"/>



<h3>Info General</h3>
<p><code>IMPORTANTE:</code> La libreria tiene como límite <b>6000</b> Emails mensuales y hasta <b>200</b> envíos por día, tomas previciones del caso</p>
<p><code>IMPORTANTE:</code> Los envío solo se realizan luego de haber pasados las validaciones del dominio.</p>


<h3>Excepciones</h3>
<p>Los errores de envío retornan mediante <b>EstatusCode</b> y <b>ErrorCode</b></p>
<p>La mejor manera de identificar el error es validando el nodo <code>Status</code> el cual indicara <b>success</b> o <b>error</b></p>

<pre><code class="language-php">
    //Muestra de Respuesta de un Error
    array(1) { 
        ["Messages"]=> array(1) { 
            [0]=> array(2) { 
                ["Errors"]=> array(1) { 
                    [0]=> array(5) { 
                        ["ErrorIdentifier"]=> string(36) "10e09288-f5ec-4d92-9721-82eaca55ea85" 
                        ["ErrorCode"]=> string(7) "mj-0013" 
                        ["StatusCode"]=> int(400) 
                        ["ErrorMessage"]=> string(47) ""direccion@hitcel" is an invalid email address." 
                        ["ErrorRelatedTo"]=> array(1) { 
                            [0]=> string(11) "To[0].Email" 
                        } 
                    } 
                } 
                ["Status"]=> string(5) "error" 
            } 
        } 
    } 

    //IDENTIFICAR EL ERROR
    $email = $this->_email
                    ->from(['account@domain.com','Name Sender','Subject'])
                    ->for(['accounreceive@domain','Receive Name','Info to Send','Info in plain text'])
                    ->send();
    if($email['Messages'][0]['Status']==error){
        echo $email['Messages'][0]['Errors'][0]['ErrorIdentifier'];//Identificador del Error
        echo $email['Messages'][0]['Errors'][0]['ErrorCode'];//Código del Error
        echo $email['Messages'][0]['Errors'][0]['ErrorMessage'];//Motivo del Error
        echo $email['Messages'][0]['Errors'][0]['ErrorRelatedTo'][0];//Relación del Error
    }

</code></pre>

<p>Tambien se pueden generar excepciones propias del builder al faltar parámetros, por ejemplo:</p>
<ul>
    <li><code>from():</code>
        <ul>
            <li>No se han enviado parámetros de Envío</li>
            <li>Los datos Enviados no son un arreglo válido</li>
            <li>Faltan Parámetros de envío</li>
            <li>Falta el Email destinatario</li>
            <li>Falta el Nombre del Destinatario</li>
            <li>Falta el Asunto del Email</li>
        </ul>
    </li>
    <li><code>for():</code>
        <ul>
            <li>Faltan o están incompletos los Parámetros de Envío</li>
            <li>Faltán parámetros del Receptor</li>
            <li>Los datos del receptor no son un arreglo válido</li>
            <li>Falta el Email del Receptor</li>
            <li>Falta el nombre del Receptor del Email</li>
            <li>Falta la Información a ser enviada en el Email</li>
            <li>Falta la información en texto plano</li>
        </ul>
    </li>
    <li><code>copy:</code>
        <ul>
            <li>Faltán parámetros de la Copia</li>
            <li>Los datos de copia no son un arreglo válido</li>
            <li>Faltán parámetros de la Copia</li>
            <li>Falta el Email del Receptor</li>
            <li>Falta el Email del receptor de la Copia</li>
            <li>Falta el Nombre del receptor de la Copia</li>
        </ul>
    </li>
    <li><code>hiddenCopy():</code>
        <ul>
            <li>Faltán parámetros de la Copia Oculta</li>
            <li>Los datos de copia no son un arreglo válido</li>
            <li>Faltán parámetros de la Copia Oculta</li>
            <li>Falta el Email del receptor de la Copia Oculta</li>
            <li>Falta el Nombre del receptor de la Copia Oculta</li>
        </ul>
    </li>
    <li><code>template():</code>
        <ul>
            <li>Faltán parámetros de la Plantilla</li>
            <li>Los datos de la Plantilla no son un arreglo válido</li>
            <li>Faltán parámetros de la Plantilla</li>
            <li>Falta el Nombre del Archivo HTMl/HTM de la Plantilla</li>
        </ul>
    </li>
    <li><code>attachFile():</code>
        <ul>
            <li>Faltán parámetros del Adjunto</li>
            <li>Los datos del adjunto no son un arreglo válido</li>
            <li>Faltán parámetros del Adjunto</li>
            <li>Falta el Tipo de Adjunto a Enviar</li>
            <li>Falta el nuevo Nombre del Adjunto a Enviar</li>
            <li>Falta la Codificación Base64 del Archivo a Enviar</li>
        </ul>
    </li>
    <li><code>contentType():</code>
        <ul>
            <li>Faltan o están incompletos los Parámetros de Envío</li>
        </ul>
    </li>
    <li><code>send():</code>
        <ul>
            <li>El tipo de Archivo a Enviar, no se encuentra registrado</li>
            <li>Faltan o están incompletos los Parámetros del Receptor del Envío</li>
            <li>No se ha podido recuperar el archivo {nombre del archivo}</li>
        </ul>
    </li>
</ul>

<p>Para Capturar los errores del builder y detectar la detención del proceso de envío, se recomienda utilizar el <b>try catch</b>, de esa manera puede detectar cualquier error que se genere</p>

<pre><code class="language-php">
    try{
        $ma = $this->email
                    ->from(['sender@domain.com','Nombre des','Subject'])
                    ->for(['receive@domain.com','Receive Name','Info to Send','Info in plain text'])
                    ->send();
    }catch(Exception $e){
        $ma = $e->getMessage();
    }

</code></pre>

<pre><code class="language-php">
</code></pre>