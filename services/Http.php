<?php

require_once __DIR__ . '/../vendor/autoload.php';
    
use GuzzleHttp\Client;

class Http {
    private Client $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function getData(){
       return $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts')->getBody();
    }
    
    
    public function post($url, $options){
        return $this->request('POST', $url, $options);
    }

}

?>