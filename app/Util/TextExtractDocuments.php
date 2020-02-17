<?php
namespace App\Util;

use GuzzleHttp\Client;

class TextExtractDocuments
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function all()
	{
		return $this->endpointRequest('http://192.168.0.8:8005/api/1.0/api_extract/');
	}

	public function findById($id)
	{
		return $this->endpointRequest('/dummy/post/'.$id);
	}

	public function endpointRequest($url)
	{
		try {
			$response = $this->client->request('POST', $url, self::setContent(['image'=>'wwwwhsys.jpg']));
			// echo ' <pre> ';
			// print_r($response->getBody()->getContents());
			// die;
		} catch (\Exception $e) {
			// print_r($e->getMessage());
			return ['response' => 'bad' , 'errors'=>['message'=>$e->getMessage()]];
		}
		return  $this->response_handler($response->getBody()->getContents());
	}
	
	public static function setContent($data, $type = 'json'){
		$requestContent['headers'] = [
			'Accept' => 'application/json',
			'Content-Type' => 'application/json'
		];
		// Le adiciona la información a enviar
		foreach ($data as $key => $value) {
			$requestContent[$type][$key] = $value;
		}
		return $requestContent;
	}

	public function response_handler($response)
	{
        if ($response) {
            return ['response'=>json_decode($response, true), 'errors'=>[]];
		}
		return [];
	}
}