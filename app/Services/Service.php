<?php

namespace App\Services;

use App\Helpers\APIResponse;
use GuzzleHttp\Client;

class Service
{
	public function __construct(Client $client) {
		$this->http = $client;
	}

	/**
	 * Creates a response with the required data
	 * 
	 * @param $data
	 * @param string $message
	 * @param int $statusCode
	 * @return App\Helpers\APIResponse
	 */
	protected function response($data, string $message, int $statusCode) {
		$response = new APIResponse();
		$response->data = $data;
		$response->message = $message;
		$response->statusCode = $statusCode;
		return $response;
	}

	/**
	 * Sends an http request
	 * 
	 * @param string $route
	 * @param array $formParams
	 * @return array
	 */
	protected function sendRequest(string $route, array $formParams, string $method) {
		try
		{
			$url = config('app.url') . $route;

			$response = $this->http->request($method, $url, ['form_params' => $formParams]);

			$statusCode = self::SUCCESS_STATUS_CODE;

			$data = json_decode((string) $response->getBody(), true);
		}
		catch (ClientException $e)
		{
			echo $e->getMessage();

			$statusCode = $e->getCode();

			$data = ['error' => 'Client error'];
		}

		return ["data" => $data, "statusCode" => $statusCode];
	}
}