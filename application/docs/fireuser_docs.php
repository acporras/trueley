<h1>Documentación Firemanager Class</h1>
<p>_Fiuremanager_ es una clase utilizada para gestionar usuarios de Google Firebase a través de un Servidor node Js, se pueden realizar funciones como Crear Usuarios, Obtener datos de un usuarios, Actualziar Usuario, Actualizar claves,  Validar Email, Activar o Suspender usuarios y Eliminar usuarios</p>

<p>La forma de invocarla donde se requiera su uso es la Siguiente:</p>

<pre><code class="language-php">
    use xfxstudios\general\Firemanager;

    public function __construct(){
        $this->_fire = new Firemanager();
    }
    
</code></pre>

<p>A partir de allí la instancia de <code>$this->_fire</code> contiene el acceso a las funciones de la clase</p>

<p>Las distintas funciones retornan los valores en un json, el cual se puede interpretar tanto en php como en javascript</p>

<h3>Agregar un usuario con <b>_AddUser</b></h3>
<p>Para agregar usuarios a firebase, se requiere de la funcion <b>_AddUser</b> para la tarea, la cual recibe un array con los datos a registrar</p>

<pre><code class="language-php">
    $send = array('a@a.com','+584144402465','14186541','Carlos Molleja');
    $this->_fire->_AddUser($send)

</code></pre>
<p>Esto retorna un arreglo con la data del usuario agregado o con la información del posible error al momento del registro</p>
<p><code>IMPORTANTE</code> para el registro de un usuario en firebase la data es obligatoria así como el Email del usuario el numero móvil deve contener el formato correcto <code>+58xxxxxxxxx</code> en caso contrario, el servidor retornara un error de registro indicando que el email o el número móvil son incorrectos </p>

<h3>Obtener datos de un usuario con <b>_GetUser</b></h3>
<p>Para obtener los datos de un usuario, utilizamos la funcion <b>_GetUser</b> la cual reciobe como parametro de búsqueda, el Email del usuario a cargar</p>

<pre><code class="language-php">
    $this->_fire->_GetUser('a@a.com');

</code></pre>
<p>Esto retorna un json con la data del usuario o los posibles errores si el usuario no existe o el email no cuenta con el formato correcto</p>

<h3>Actualziar Móvil y Nombre con <b>_SetNamePhone</b></h3>
<p>En esta funcion por cuestiones de validacion, ambos valores son obligatorios y es requerido el <code>uid</code> en firebase del usuario para dicha modificación de datos:</p>

<pre><code class="language-php">
    $datos = array('uid del usuario','+58xxxxxxx',str_replace(" ","%20",'nombre del usuario'));
    var_dump($this->_fire->_SetNamePhone($datos));

    //Ejemplo
    $datos = array('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1','+584161234567',str_replace(" ","%20",'Jhon Doe'));
    var_dump($this->_fire->_SetNamePhone($datos));

</code></pre>
<p>Esta funcion luego de dicha actualización retorna la data del usuario actualziada</p>

<h3>Actualizar Email de Usuario con <b>_SetEmail</b></h3>
<p>Esta funcion le permite actualziar el email de usuario en Firebase, requiere del UID y el nuevo Email del usuario para realizar las acciones:</p>

<pre><code class="language-php">
    $datos = array('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1','ab@aa.com');
    var_dump($this->_fire->_SetEmail($datos));

</code></pre>
<p>Al Igual que funciones anteriores retorna la data del usuario actualziado o .los mensajes de error en caso de ser repetido el email, uid incorrecto o formato de email no válido</p>


<h3>Validar Email de Usuario con <b>_ValidateEmail</b></h3>
<p>Esta funcion le permite validar en Firebase un Email de usuario, es utilizada con funciones de registro de nuevos usuario al validar o activar sus cuentas por email</p>

<pre><code class="language-php">
    //Solo se requiere el UID del usuario a validar
    $this->_fire->_ValidateEmail('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1');

</code></pre>
<p>Retorna un objeto con la data del usuario validado</p>


<h3>Actualziar la Clave de un usuario con <b>_UpdatePass</b></h3>
<p>Esta funcion le permite validar la clave de un usuario contenida en Firebase, es necesario si se esta realizando autenticación doble, actualziar primero en firebase antes que en su base local</p>

<pre><code class="language-php">
    //Se envian la UID y la nueva Clave para su actualziación
    $datos = array('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1','123456789');
    $this->_fire->_UpdatePass($datos);

</code></pre>
<p>Retorna la data del usuario actualziado como objeto</p>


<h3>Suspender un usuario con <b>_SuspendUser</b></h3>
<p>Es posible suspender de accesos a un usuario registrado en Firebase con las siguientes lineas</p>

<pre><code class="language-php">
    //Recibe como parametro el UID del usuario a desactivar
    $this->_fire->_SuspendUser('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1');

</code></pre>
<p>Retorna la data del usuario desactivado como objeto</p>

<h3>Reactivar un usuario con <b>_ActivateUser</b></h3>
<p>una vez desactivado un usuario, es posible reactivarlo con la siguiente secuencia:</p>

<pre><code class="language-php">
    //Recibe como parámetero el UID del usuario a reactivar
    $this->_fire->_ActivateUser('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1');

</code></pre>
<p>Retorna la data del usuario Activado como objeto</p>

<h3>Eliminar un usuario con <b>_DeleteUser</b></h3>
<p>Es posible eliminar un usuario de Firebase con la siguiente funcion:</p>
<p><code>INPORTANTE: <b>Esta función es irreversible</b></code> </p>

<pre><code class="language-php">
    //Recibe el UID del usuario a Eliminar
    $this->_fire->_DeleteUser('uep6JxJM0OYBZ9Xh2J8HcFcfMLl1');

</code></pre>
<p>Retorna un objeto con la respuesta del proceso de eliminación</p>

<pre><code class="language-php">
</code></pre>