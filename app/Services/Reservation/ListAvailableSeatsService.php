<?php

namespace App\Services\Reservation;

use App\Helpers\APIResponse;
use App\Reservation;
use App\Services\Service;
use Illuminate\Http\Request;

class ListAvailableSeatsService extends Service
{
	/**
     * List available seats
     * 
     * @param Illuminate\Http\Request $request
	 * @return App\Helpers\APIResponse
     */
	public function list(Request $request)
	{
		$date = $request->input('date');
		$originCityId = $request->input('origin_city_id');
		$destinationCityId = $request->input('destination_city_id');

		$data = Reservation::getAvailableSeats($date, $originCityId, $destinationCityId);

		if (!empty($data))
		{
			$message = "Found seats with the required parameters";
			$statusCode = APIResponse::SUCCESS_STATUS_CODE;
		}
		else
		{
			$message = "No seats found with the required parameters";
			$statusCode = APIResponse::NOT_FOUND_STATUS_CODE;
		}

		return $this->response($data, $message, $statusCode);
	}
}