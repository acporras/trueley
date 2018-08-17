<h1>Documentación de GeneralClass</h1>
<p><b>GeneralClass</b> cuenta con una buena cantidad de funciones utilitarias que le ayudaran dentro del sistema desde la generación de fechas hasta la creación de hashes de clave</p>

<h3>Implementar <b>GeneralClass</b></h3>
<p>Para implementar la clase, debe seguir las siguientes líneas de código</p>

<pre><code class="language-php">
    use xfxstudios\general\GeneralClass;

    public function __construct(){
        $this_general = new GeneralClass();
    }

</code></pre>
<p>A partir de este momento la instancia <code>$this->_general</code> contiene el acceso a las funciones de GeneralClass</p>


<h3>Función <b>idioma</b></h3>
<p>La funcion idioma retorna <b>es</b> si el navegador o la sesión esta fijada en este idioma o <b>en</b> para cualquier otro idioma</p>

<pre><code class="language-php">
    var_dump($this->general->idioma());
    //Imprime es ó en

</code></pre>

<h3>Función <b>claveusuario</b></h3>
<p>Esta funcion genera un hash de clave a partir de la cadena pasada, retornandola encriptada</p>

<pre><code class="language-php">
    $data = "123456789";
    var_dump($this->_general->claveusuario($data));

</code></pre>

<h3>Función <b>city</b></h3>
<p>Esta funcion retorna información geográfica de acuerdo a la I=P del usuario Conectado, como, ciudad, país, estado, código postal, latitud, longitud, zona horaria</p>

<pre><code class="language-php">
    $ip = '192.165.22.200';
    $ret = $this->_general->city($ip);

    //En $ret queda almacenado un arreglo de esta manera
    $ret = (object) array(
        'isoCode'   => '',
        'nombre'    => '',
        'estado'    => '',
        'isoEstado' => '',
        'ciudad'    => '',
        'postal'    => '',
        'latitud'   => '',
        'longitud'  => '',
        'timezone'  => '',
    );

</code></pre>
<p><code>NOTA: </code>Esta funcion tambien se puede invocar sin pasarle la IP y ella tomará la IP del usuario conectado</p>


<h3>Función <b>country</b></h3>
<p>Al igual que la función city, esta retorna un objeto con la data de un país, puede recibir una ip como parámetro o invocarla con un valor nulo y esta tomará la IP del usuario conectado</p>

<pre><code class="language-php">
    $ip = '192.165.22.200';
    $ret = $this->_general->country($ip);

    //En $ret queda almacenado un arreglo de esta manera
    $ret = (object) array(
        'continente'    => '',
        'continente_id' => '',
        'pais_id'       => '',
        'iso_code'      => '',
        'pais'          => ''
    );

</code></pre>

<h3>Función <b>calfechas</b></h3>
<p>Esta funcion suma o resta un número determinado de días a una fecha enviada, la función recibe un arrayn con la data a procesar con los siguientes valores: <code>Fecha en formato Y-m-d</code>, <code>s ó r dependiendo de si es suma o resta de días</code>, el tercer parámetro es la cantidad a sumar o restar</p>

<pre><code class="language-php">
    //Suma  dúias a la fecha enviada
    $val = array('2018-01-30','s',5);
    $this->_general->calfechas($val);
    
    //Resta  dúias a la fecha enviada
    $val = array('2018-01-30','r',5);
    $this->_general->calfechas($val);

    //Tambioen se puede enviar el valor como nulo y automaticamente lo tomará como resta de días
    $val = array('2018-01-30','',5);
    $this->_general->calfechas($val);


</code></pre>
<p><code>NOTA: </code> esta función retornara <code>false</code> si no se pasa el parámetros de cantidad ó si el valor enviado no es un array</p>
<p><code>NOTA: </code> de igual manera si no es enviada la fecha, este tomará la fecha del día para calcular</p>


<h3>Función <b>date</b></h3>
<p>Esta funcion retorna un objeto con una variedad de formatos de fecha</p>

<pre><code class="language-php">
    var_dump($this->_general->date())

    //Retorna:
    $array = (object) array{ 
        "datetime"  => "2018-05-24 17:04:52",
        "date"      => "2018-05-24",
        "time"      => "17:04:52",
        "microtime" => "17:04 pm",
        "large"     => "Thursday, 24 May 2018 - 17:04 hrs",
        "extra"     => "Thursday 24 de May del 2018",
        "iso"       => "2018-05-24T17:04:52-04:00",
        "seconds"   => "1527195892",
        "format"    => "Thu, 24 May 2018 17:04:52 -0400",
        "unix"      => 1527195892,
    }

</code></pre>

<h3>Función <b>cortarTexto</b></h3>
<p>Esta función acorta un texto agregandole 3 puntos al final, calculando la cantidad de caracteres indicados, recibe como parametros la cadena a cortar y la cantidad de caracteres a mostrar</p>

<pre><code class="language-php">
    $cadena = "Esta es una muestra de cadena enviada a calcular";
    echo $this->_general->cortartexto($cadena,10);

    //retorna: Esta es una...

</code></pre>

<h3>Función <b>claveUnica</b> y <b>getCodigo</b></h3>
<p>Ambas funciones generan una cadena aleatorea, recibe como parámetro la longitud de la cadena a retornar, si se invoca sin enviar la longitud, esta retornara una cadena de 10 digitos por defecto, si es enviado un valor no numerico, retornada <code>false</code></p>

<pre><code class="language-php">
    var_dump($this->_general->claveUnica(5));
    var_dump($this->_general->getCodigo(5));

</code></pre>


<h3>Función <b>limpiaNumero</b></h3>
<p>Esta función se encarga de eliminar simbolos de una cadena numerica o de texto:</p>

<pre><code class="language-php">
    $cadena = '414-440.24.65';
    var_dump($this->_general->limpiaNumero($cadena));ç

    //retorna 4144402465

</code></pre>


<h3>Función <b>fechalan</b> y <b>fechalanST</b></h3>
<p>Retorna la fecha Formateada de acuerdo a si es español o Inglés</p>

<pre><code class="language-php">
    $fecha = '2018-05-10 13:20:00';
    $this->_general->fechalan($fecha); //Retorna en:2018-05-10 13:20:00 es:10-05-2018 13:20:00
    $this->_general->fechalanST($fecha); //Retorna en:2018-05-10 es:10-05-2018

</code></pre>

<h3>Función <b>IPreal</b></h3>
<p>Retorna la IP real del usuario conectado</p>

<pre><code class="language-php">
    var_dump( $this->_general->IPreal() );
    //Retorna la IP del Usuario

</code></pre>



<pre><code class="language-php">
</code></pre>