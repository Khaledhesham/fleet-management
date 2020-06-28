<?php

namespace App\Services\Reservation;

use App\Helpers\APIResponse;
use App\Seat;
use App\Services\Service;
use Carbon\Carbon;
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
		$date = Carbon::parse($request->input('date'));
		$originCityId = $request->input('origin_city_id');
		$destinationCityId = $request->input('destination_city_id');

		$data = Seat::getAvailableSeats($date, $originCityId, $destinationCityId);

		if (!$data->isEmpty())
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