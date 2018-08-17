<?php
/**
 * Libreria que se encarga del manejo de peticiones a twitter
 */
class My_twitter
{
    private $key         = 'pgw12YNl31qNi6nSJkjJhEo5F';
    private $secretKey   = 'ZLwmCg0clDSahxG9h6fYJoPXEtzoogwGWZmBUMpZSlXqDVzNGs';
    private $token       = '3433453439-0sgiUaU2iNPhQmy2uJrXuzv9yiFGskN9nFC8f6z';
    private $secretToken = '7iKgBmifaDeGEv0SyLKQiRoOp2fA29owunp6DZC7SYNBN';
    private $url         = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    private $getMethod   = 'GET';
    private $postMethod  = 'POST';

    public function __construct(){
        $this->config = array(
            'oauth_access_token' => $this->token,
            'oauth_access_token_secret' => $this->secretToken,
            'consumer_key' => $this->key,
            'consumer_secret' => $this->secretKey
        );
    }//

    /**
     * Retorna la lista de los últimos twites de un usuario
     * Recibe coo parametros nombre y cantidad mediante un objeto
     * Ej.
     * $this->my_twitter->getTwits((object)array('name'=>'userName', 'cant'=>'10', 'type'=>'json'));
     * Retorna un objeto con los últimos Twits del Usuario
     */
    public function getTwits($X){
        $getfield = '?screen_name='.$X->name.'&count='.$X->cant;
        $requestMethod = $this->getMethod;
        $twitter = new TwitterAPIExchange($this->config);
        $json =  $twitter->setGetfield($getfield)
                            ->buildOauth($this->url, $requestMethod)
                            ->performRequest();
        return ($X->type=='json') ? $json : json_decode($json);
    }
}
