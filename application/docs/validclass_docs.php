<h1>Documentación sobre Valid Class</h1>
<p>La Libreria <b>Valid</b> es utlizada para la creación de tokens de autenticación, los cuales serán utilizados para validar las peticiones de formularios, peticiones de api y la sesión de un usuario, de esta manera mantener la seguridad del sitio.</p>
<p>El modo de implementación es:</p>
<pre><code class="language-php">
    &#60;?php
    use xfxstudios\general\Valid;

    class Someclass{

        public function construct(){
            $this->_valid = new Valid();
        }
    }
    ?>
</code></pre>
<h3>Generar un Token de Autenticación con <b>_SignIn</b></h3>
<p>Para generar un token de autenticación, se debe utilizar la funcion <b>_SignIn</b> de Valid, de la siguiente manera</p>
<pre><code class="language-php">
    $data = array(
        "user"  =>  "a@a.com",
        "level" =>  "Admin",
        "app"   =>  "RRHH"
    );
    $token = $this->_valid->_SignIn($data);

    //Esto retorna un token de autenticación parecido a lo Siguiente:
    //eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MjcxODQ4NjUsImV4cCI6MTUyNzE4ODQ2NSwiZXJyIjoiIiwiYXVkIjoiOWZmYjU1YjYyNWU4Nzc3OTVmMjEzMDBlM2E1MWY1NmU3N2UwZTY3YSIsImRhdGEiOnsiaWQiOjEsIm5hbWUiOiJFZHVhcmRvIn19.uMr3OsgPT2kobxgdx4uLkznampekvVGKHOYy5wA-cxU
</code></pre>

<h3>Validar Token con <b>_Check</b></h3>
<p>Para realziar la validación de un token he identificar si no es válido bien sea por tiempo expirado o por secret key erronea, se utiliza la funcion <b>_Check</b> de la siguiente manera</p>


<pre><code class="language-php">
    //Ejemplo de Uso de _Check

    $token = $this->session->token;//Token almacenado en sesion
    //Verificamos el nodo error si esta en true
    if($this->_valid->_Check($token)->error){
        //Si es positivo retornamos el motivo del error
        echo $this->_valid->_Check($token)->message;
        exit;
    }
    //En caso contrario continuamos con el código
</code></pre>
<p>La misma funcion <b>_Check</b> nos retorna la data del Token si este es válido para poder utilizarla de la manera que dessemos, dicha data viene en formato objeto array de php</p>

<pre><code class="language-php">
    //Ejemplo de retorno de Data
    object(stdClass)#83 (5) {
         ["iat"]    => int(1527186538) 
         ["exp"]    => int(1527190138) 
         ["error"]  => bolean(5) false 
         ["aud"]    => string(40) 
         "9ffb55b625e877795f21300e3a51f56e77e0e67a" 
         ["data"]  => object(stdClass)#84 (2) { 
             ["id"]     => int(1) 
             ["name"]   => string(7) "Eduardo" 
        } 
    } 
</code></pre>

<h3>Datos del Token con <b>_GetData</b></h3>
<p>Podemos obtener la data de un token para su validación o uso utilizando la funcion <b>_GetData</b> de Valid, de la siguiente manera</p>

<pre><code class="language-php">
    $token = $this->session->token;
    $datos = $this->_valid->_GetData($token);

    //Esto retorna el siguiente objeto
    $datos = (object) array(
        "iat"   =>  1527186538,
        "exp"   =>  1527190138,
        "error" =>  false,
        "aud"   =>  9ffb55b625e877795f21300e3a51f56e77e0e67a,
        "data"  =>  (object) arrray(
            "id"    =>  1,
            "name"  =>  "Eduardo"
        )
    )

</code></pre>
<p>La cual podremos utilizar en nuestras clases para su validacion o muestra. De igual manera esta funcion consulta a <b>_Check</b> para verificar el token que recibe</p>

<h3>Valores devueltos en <b>_GetData</b> y <b>_Check</b></h3>
<ul>
    <li><code>iat</code> (Fecha y Hora de creacion del token en formato unix)</li>
    <li><code>exp</code> (Fecha y Hora de expiración del token en formato unix)</li>
    <li><code>error</code> (Booleano true o false indicando si hay o no error en la respuesta)</li>
    <li><code>aud</code> (Conjunto de datos codificados en SHA1 para diferentes usos y validaciones )</li>
    <li><code>data</code> (Array de datos en formato objet con la informacion agregada al token )</li>
</ul>

<p>Adicionalmente la funcion _Check podría retornar excepciones de error en caso de haberlas como las siguientes:</p>
<ul>
    <li><code>Invalid or empty token supplied</code> (No se ha enviado un token o no se ha podido validar)</li>
    <li><code>Invalid user logged in</code> (El usuario no se encuentra logueado o su sesion es inválida)</li>
    <li><code>Signature verification failed</code> (La firma o clave secreta no es válida)</li>
    <li><code>Expired token</code> (El token ha espirado el tiempo de vida sin renovarse)</li>
</ul>

<p>La clase depende de un archivo ini con la data secreta de uso, por ejemplo:</p>
<pre><code class="language-php">
    ; Datos para Generacion de Token
    [token]
    ;Secrete key
    secret_key = clavesecreta
    ;Algoritmo de escriptacion
    encrypt = HS256
    ;Horas validas de un token luego de su renovacion
    hours = 1
</code></pre>



