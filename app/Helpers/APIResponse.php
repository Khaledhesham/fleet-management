<?php

namespace App\Helpers;

class APIResponse
{
	const SUCCESS_STATUS_CODE = 200;
	const UNAUTHORIZED_STATUS_CODE = 401;

	public $data;
	public $message;
	public $statusCode;

	/**
	 * Formats message for response
	 * 
	 * @return Illuminate\Http\Client\Response
	 */
	public function format()
	{
		if ($this->statusCode == self::SUCCESS_STATUS_CODE)
		{
			return response()->json(["data" => $this->data, "message" => $this->message], $this->statusCode);
		}
		else
		{
			return response()->json(["errors" => $this->data, "message" => $this->message], $this->statusCode);
		}
	}

}
