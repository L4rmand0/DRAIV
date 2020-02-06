<?php 

namespace App\Traits;
use GuzzleHttp\Client;

trait ApiConsume {
    public function make($url, $method = 'GET'){
        $client = new Client();
        $response = $client->request($method, $url);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        return $body;
    }
}