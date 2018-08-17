<h1>Uso de Libreria GuzzleHTTP</h1>
<p>La libreria <b>GuzzleHTTP</b> es utlizada para realizar peticiones cURL tanto internas como a otros dominios, en este caso será utilizada para las comunicaciones entre APIs de la SUITE.</p>

<h3>Modo de Implementarla</h3>
<p>Para Implementar la libreria en el Controlador o modelo donde se requiera su uso, se debe realizar los siguiente:</p>

<pre><code class="language-php">
    use GuzzleHttp\Client;

    public function __construct(){
        $this->_client = new Client([
            'base_uri' => 'https://url_de_la_app.com/api/'
        ]);
    }

</code></pre>

<p>Los métodos a utilizar para la Comunicación serán <code>POST</code> y <code>GET</code></p>

<h3>Realizar Petición <b>POST</b></h3>
<p>Ejemplo de una Petición POST</p>

<pre><code class="language-php">
    try{
        $response = $this->_client->request('POST', 'funcion_en_la_api', [
            'form_params' => [
                'token'       => $this->session->token,//Obligatorio para validar la comunicación
                //Resto de valores a ser enviados a procesar
                'clave1'       => 'valor1',
                'clave2'       => 'valor2',
            ]
        ]);
        //Si todo fué correcto recivimos la respuesta de nuestra api
        return $response->getBody()->getContents();
    }catch(Exception $e){
        //En caso de error
        return $e->getMessage();
    }

</code></pre>

<p>En nuestra API tendriamos algo parecido a esto esperando la petición</p>

<pre><code class="language-php">
    public function funcion_en_la_api_post(){
        $re = $this->mapi->validNotifi($_POST);
        $da = (object) array(
            'DATOS' =>  $re
        );
        return $this->response($da);
    }

</code></pre>
<p>Clomo se puede apreciar, el nombre de la funcion esta compuesto de <code>nombredeafuncion</code>_<code>metodo_aceptado</code></p>
<p><code>NOTA:</code> Las funciones de la API no deben llevar piso <code>_</code> salvo el separador de nombre y metodo. Ejemplo: <code>nombredefuncion_post</code></p>

<h3>Petición <b>POST</b> de tipo Multipart/form-data</h3>
<p>De igual manera se pueden enviar tanto datos como archivos en una misma petición post si se requiere</p>

<pre><code class="language-php">
    try{
        $response = $this->_client->request('POST', 'funcionupload', [
            'multipart' => [
                [
                    'name'     => 'nombre_cmapo1',
                    'contents' => 'contenidoCampo1'
                ],
                [
                    'name'     => 'nombre_campo_archivo',
                    'contents' => fopen('/ruta/al/archivo', 'r')
                ],
                [
                    'name'     => 'nombre_campo2',
                    'contents' => 'contenidoCampo2',
                ]
            ]
        ]);
        return $response_>getBody()->getContents();

    }catch(Exception $e){
        return $e->getMessage();
    }

</code></pre>
<p>Como se puede apreciar se hace uso de la funcion <code>fopen</code> para acceder al archivo a ser enviado a nuestra api, dicho archivo se debe encontrar en un directorio de nuestro server, en caso de encontrase en un <b>Bucket</b>, se debe realizar primero la descarga con la librería <b>Storage</b> antes de ser procesado su envío.</p>


<h3>Peticiones <b>GET</b></h3>
<p>La peticiones GET, se utilizan para solicitar datos a la api, por ejemplo, datos de un usuario, una lista de usuarios o XX dato que se requiera, esta petición se puede enviar con o sin parámetros, aunque en el caso de la SUITE, esta debe contener el parametro del token para poder ser procesada.</p>

<pre><code class="language-php">
    try{
        $response = $this->_client->request('GET', 'functionenlaapi', [
            'query' => [
                    'token' => $this->session->token,
                    'clave' => 'valor',
                    'claveB' => 'valorB',
                    ]
        ]);
        return $response->getBody()->getContents();

        }catch(Exception $e){
        return $e->getMessage();
    }

</code></pre>

<h3>Excepciones</h3>
<p>El Sistema generará Excepciones en caso de haber errores durante el proceso de una petición o las recibidas desde el servidor</p>
<p>Las excepciones comunes son:</p>

<ul>
    <li>Metodo de Petición no existente <code>(Method not Alowed)</code> en la API, por ejemplo enviar una petición POST a una funcion que espera una petición GET, el mismo error se obtendra si se intenta acceder de manera directa o se envia una petición vacía (no enviada a nunguna función)</li>
    <li>Otras Como errores propios del framework por fallos durante la codificación</li>
    <li>No comunicación con el Servidor o la Aplicación</li>
</ul>

<p>El Retorno de una respuesta no siempre es positiva, por ejemplo, prodría estarse recibiendo la respuesta de error en la validación del token enviado.</p>

<p><code>IMPORTANTE:</code>La respuesta de la API son en formato <code>JSON</code> y deben ser compuestas a partir de un objeto, en caso contrario se recibe un error, esto no aplica para las respuestas directas de una consulta a la base de datos, ya que CI retorna un objeto como respuesta. </p>

<pre><code class="language-php">
</code></pre>