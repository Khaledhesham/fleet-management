<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveSeatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|string|date|after_or_equal:today',
            'origin_city_id' => 'required|integer|exists:cities,id',
            'destination_city_id' => 'required|integer|exists:cities,id',
            'seat_id' => 'required|integer|exists:seats,id',
            'trip_date_id' => 'required|integer|exists:trip_dates,id',
        ];
    }
}
