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
		return $this->endpointRequest('http://localhost:8000/calculaedad/60/2040');
	}

	public function findById($id)
	{
		return $this->endpointRequest('/dummy/post/'.$id);
	}

	public function endpointRequest($url)
	{
		// dd($url);
		try {
			$response = $this->client->request('GET', $url);
			echo ' entra '. $response;
			die;
		} catch (\Exception $e) {
			dd($e);
			return [];
		}

		return $this->response_handler($response->getBody()->getContents());
	}

	public function response_handler($response)
	{
		if ($response) {
			return json_decode($response);
		}
		
		return [];
	}
}