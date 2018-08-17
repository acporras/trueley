<h1>Documentación sobre Storage Class</h1>
<p><b>Storage</b> es una clase que se utiliza para la carga de archivos a un bucket de almacenamiento dentro de Google Cloud Platform, la forma de invocarla es la siguiente:</p>

<pre><code class="language-php">
    use xfxstudios\general\Storage;
    use xfxstudios\Exception\Storageexception;

    public function __construct(){
        $this->_storage = new Storage();
    }
</code></pre>

<p>Cuenta con 3 Funciones principales que son <b>_Cargar</b> y <b>_Borrar</b> que se explican a continuación</p>

<h3>Carga de archivo con <b>_Cargar</b></h3>
<p>Para cargar un archivo debemos primero llevarlo a una carpeta temporal dentro del server, la cual se debe especificar en el archivo de control <b>ini</b>, en este caso utilizaremos la libreria <b>upload</b> de Codeigniter</p>
<p>Podemos pasar Parámetros al Builder para su ejecución, las funckiones que intervienen son <b>nameFile()</b>, <b>file()</b>, <b>path()</b> y <b>_Load()</b></p>
<p><code>$this->storage->nameFile('nombreDelArchivo')->file('arrayDatadeCarga')->folder('nuevaCarpeta')->_Cargar();</code></p>

<pre><code class="language-php">

    //Validamos la imagen para descartar posibles ataques XSS
    if($this->security->xss_clean($_FILES['file'],TRUE)===FALSE){
        log_message('error', 'Archivo Dañado o posible ataque XXS');
        return false;
    }

    //Recibimos el archivo desde el formulario
    $n = $_FILES['file']['name'];
    //Extraemos la extension del archivo
    $ext = explode(".",$n);

    //Preparamos un nuevo nombre del archivo
    $nuevo = "adic_".uniqid().'.'.$ext[1];

    //Tomamos la ruta de carga
    $ruta = $this->ini['upload']

    //Preparamos la configuración de carga
    $config['file_name']     = $nuevo;
    $config['upload_path']   = $ruta;
    $config['allowed_types'] = 'jpg|png|doc|docx|xls|xlsx|ppt|pptx|pdf';

    //Cargamos la libreria
    $this->load->library('upload', $config);

    //Validamos la carga del archivo
    if (!$this->upload->do_upload('imagen')){
        $error = array('error' => $this->upload->display_errors());
        log_message('error', json_encode($error));
        return false;
    }

    //Si la carga es correcta, obtenemos la Informacion del archivo cargado
    $file = $this->upload->data();

    //Cargamos el Archivo al Bucket de Cloud Storage
    try{
        $this->storage
                    ->nameFile($nuevo)
                    ->file($file)
                    //->folder('folder')/*Opcional*/
                    ->_Load();
    //Captura las Excepciones de la Libreria
    }catch(Storageexception $e){
        if($e->_getOptions()['errorCode'] != '202' ){
            unlink($ruta.$nuevo);
            return $e->_getMessage().'-'.$e->_getOptions()['errorCode'];
        }else{
            unlink($ruta.$nuevo);
            return $e->_getMessage().'-'.$e->_getOptions()['errorCode'];
        }

    //Captura las Excepciones propias de PHP (Opcional)
    }catch(Exception $x){
        return $x->getMessage();
    }

</code></pre>

<p>La carpeta del Archivo cargado en <b>folder()</b> es opcional, ya que el sistema trabaja con la carpeta configurada por defecto si se omite en el builder, de lo contrario, validara la carpeta y buscará allí el archivo</p>

<p>La lista de Archivos Admitidos es la Siguiente:</p>
<ul>
    <li>jpg</li>
    <li>jpeg</li>
    <li>png</li>
    <li>doc y docx</li>
    <li>xls y xlsx</li>
    <li>ppt y pptx</li>
    <li>pdf</li>
    <li>mp4</li>
</ul>

<p>Los archivos son almacenados categorizados en carpetas del bucket como images, documents, videos o uncategorized para las extensiones no reconocidas.</p>
<p><code>IMPORTANTE: </code> La librería retorna un string como codigo correcto el número <code>200</code>, o la excepción arrojada, no validar con <code>TRUE</code> ya que podría obtenerse un falso positivo de exito.</p>

<h3>Borrar un archivo con <b>_Borrar</b></h3>
<p>Para eliminar un archivo del bucket se utiliza la funcion <b>_delFile()</b> la cual recibe la data del archivo a eliminar</p>

<pre><code class="language-php">
    //Solicitud de eliminacion de Google storage del archivo
    try{
        $this->storage->nameFile('fileName.jpg')->_extension('jpg')->_delFile();
    }catch(Storageexception $e){
            return $e->_getMessage().'-'.$e->_getOptions()['errorCode'];
    }catch(Exception $x){
        return $x->getMessage();
    }

</code></pre>

<p>Si se esta utilizando una base de datos para almacenar los datos de los archivos cargados, se realziaria de la siguiente manera:</p>
<pre><code class="language-php">

    //Cargamos la data desde la base de datos
    $this->db->select('*');
    $this->db->from('tabla');
    $this->db->where('id =',$X);
    $q = $this->db->get()->row();

    //Solicitud de eliminacion de Google storage del archivo
    try{
        $this->storage->nameFile($q->file)->_extension($q->ext)->_delFile();
    }catch(Exception $e){
        return $e->getMessage();
    }
    //Si no ocurrieron excepciones, Eliminamos el Archivo de la base de datos
    $this->db->query("DELETE FROM tabla WHERE id = '$x'");

</code></pre>

<h3>Descargar un Archivo</h3>
<p>Para descargar un archivo, se utiliza el Builder, enviando los siguientes parámetros</p>
<p><code>$this->storage->nameFile('nombreArchivo')->_extension('extension')->folder('carpetaDescarga')->_downFile();</code></p>

<pre><code class="language-php">
    $file = $this->storage->nameFile('file.jpg')->_extension('jpg')->folder('downloads')->_downFile();

</code></pre>
<p>Esta funcion retorna un código <code>200</code> para el caso de exito, o excepciones de Error de acuerdo al caso</p>
<p><code>IMPORTANTE: </code> no validar con <code>TRUE</code> por que podría recibir un falso positivo</p>
<p><code>IMPROTANTE: </code> La carpeta de descargas debe encontrase dentro del directorio de aplicacion, en caso contrario retornara una excepción.</p>


<h3>Excepciones</h3>
<p>Estas Son algunas de las excepciones que podría recibir en casos de Errores</p>
<ul>
    <li>Cod.214 (No se ha enviado el Nombre del Archivo)</li>
    <li>Cod.212 (No se ha enviado la data del archivo cargado)</li>
    <li>Cod.210 (La data del Archivo cargado no es un arreglo válido)</li>
    <li>Cod.208 (El archivo que intenta descargar, no se encuentra en el Directorio Temporal)</li>
    <li>Cod.206 (No se ha indicado una Ruta válida)</li>
    <li>Cod.220 (El directorio indicado no existe)</li>
    <li>Cod.222 (No se ha enviado la Extensión del Archivo)</li>
    <li>Cod.224 8La Extensión enviada no es Válida)</li>
    <li>Cod.226 (La Extensión enviada no coincide con el nombre enviado)</li>
    <li>Cod.204 8No se ha detectado la Extensión del Archivo)</li>
    <li>Cod.202 (Error al intentar eliminar el archivo del directorio)</li>
    <li>Cod. 230 (Ha ocurrido un error inesperado al intentar descargar el archivo)</li>
</ul>

<p>Para La lista de Errores de las Excepciones de Google, por favor, revisar el siguiente enlace: <a href="https://cloud.google.com/storage/docs/xml-api/reference-status#standardcodes" target="_blank">EXCEPCIONES</a></p>