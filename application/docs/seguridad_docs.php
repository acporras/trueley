<h1>Seguridad en la Aplicación</h1>
<p>La Seguridad en la Aplicación es Importante, por ende debes seguir estas Reglas:</p>

<h3>Variables de Seguridad</h3>
<p>Las Variables de Seguridad estan ontenidas en una única variable de sesion, la cual almacena la información creada durante el login del usuario, esta esta en cada Controlador y se crea durante la validación del token</p>

<pre><code class="language-php">
    var_dump($this->_session);
    //retorna un array con los datos contenidos de la sesion

</code></pre>
<p>El token de seguridad se actualzia con cada ingreso en los distintos controladores, tiene una duración base de 1 hora si no se esta en uso la web, por ende pasados unos segundos luego de la hora, si el usuario no actualizo su token, el sistema deslogueara al usuario enviando al login.</p>

<p>Si el usuario al momento de ingresar tildo la opcion de <code>recordar</code>, al momento de expirar el token, el sistema lo re-logueará con una nueva sesión.</p>

<p>Si el usuario presiona el boton <code>Salir/Logout</code>, automaticamente la sesión expira y es destruida, por ende, deberá loguearse de nuevo, incluso si tildo la opción de recordarlo.</p>

<h3>Seguridad en Formularios</h3>
<p>Los formularios serán enviados mediante metodo <code>POST</code>, por ende se debe agregar un campo oculto el cual será validado por Ci para verificar la integridad de la petición</p>

<pre><code class="language-php">
    &#60;input type="hidden" name="&#60;?php echo $this->security->get_csrf_token_name();?>" value="&#60;?php echo $this->security->get_csrf_hash();?>">

</code></pre>

<p>Para peticiones ajax, se deberá seguir el siguiente ejemplo:</p>

<pre><code class="language-javascript">
        $.post('url',{
            csrf_test_name : '&#60;?php echo $this->security->get_csrf_hash(); ?>',
            data:'resto de la data'
        })
        .done(function(resp){
            //Respuesta
        })
        .fail(function(err){
            //Fallo de envio
        })
</code></pre>

<h3>Limpieza de campos de formulario</h3>
<p>Es obligatorio limpiar la data que llega desde los formularios, incluso si son archivos como imagenes y/o documentos</p>

<pre><code class="language-php">
    //Limpieza de un campo
    $nombre = $this->security->xss_clean($this->imput->post('nombre'))

    //Limpieza y validación de un archivo

    $file = $_FILES['archivo'];
    if($this->security->xss_clean($file,TRUE)===FALSE){
        //Archivo infectado o dañado
        return false;
    }

</code></pre>

<pre><code class="language-php">
</code></pre>