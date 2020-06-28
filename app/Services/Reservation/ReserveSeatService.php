<?php

namespace App\Services\Reservation;

use App\Helpers\APIResponse;
use App\Reservation;
use App\Seat;
use App\Services\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveSeatService extends Service
{
	/**
     * Reserves a seat
     * 
     * @param Illuminate\Http\Request $request
	 * @return App\Helpers\APIResponse
     */
	public function reserve(Request $request)
	{
		$date = Carbon::parse($request->input('date'));
		$originCityId = $request->input('origin_city_id');
		$destinationCityId = $request->input('destination_city_id');
		$seatId = $request->input('seat_id');
		$tripDateId = $request->input('trip_date_id');

		$data = Seat::getAvailableSeats($date, $originCityId, $destinationCityId);
		$required_reservation_data = $data->firstWhere(['seat_id' => $seatId, 'dst_id' => $tripDateId]);

		if ($required_reservation_data !== null)
		{
			$data = new Reservation();
			$data->seat_id = $seatId;
			$data->origin_city_id = $originCityId;
			$data->destination_city_id = $destinationCityId;
			$data->trip_date_id = $tripDateId;
			$data->user_id = $request->user()->id;
			$data->date = $date;
			$message = "Reserved successfully";
			$statusCode = APIResponse::SUCCESS_STATUS_CODE;
		}
		else
		{
			$data = NULL;
			$message = "The required seat doesn't exist";
			$statusCode = APIResponse::NOT_FOUND_STATUS_CODE;
		}

		return $this->response($data, $message, $statusCode);
	}
}