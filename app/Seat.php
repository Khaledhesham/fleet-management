<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seat extends Model
{
    protected $fillable = [
        'bus_id', 'row', 'column'
    ];

    /**
     * Retrieves seat bus
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }


    /**
     * Get available seats on a certain day from origin city to destination
     * 
     * @param Carbon\Carbon $date
     * @param int $originCityId
     * @param int $destinationCityId
     */
    public static function getAvailableSeats(Carbon $date, int $originCityId, int $destinationCityId)
    {
        $seats = DB::table('seats')
                 ->join('buses', 'buses.id', '=', 'seats.bus_id')
                 ->join('trips_buses', 'trips_buses.bus_id', '=', 'buses.id')
                 ->join('trips', 'trips.id', '=', 'trips_buses.trip_id')
                 ->join('trip_dates', 'trips.id', '=', 'trip_dates.trip_id')
                 ->leftJoin('reservations', 'seats.id', '=', 'reservations.seat_id')
                 ->leftJoin('trips_cities as origin_trip_city', 'reservations.origin_city_id', '=' , 'origin_trip_city.city_id')
                 ->leftJoin('trips_cities as destination_trip_city', 'reservations.origin_city_id', '=' , 'destination_trip_city.city_id')
                 ->where(DB::Raw($originCityId), '<>', DB::Raw($destinationCityId))
                 ->where('trip_dates.weekday', $date->dayOfWeek)
                 ->whereIn('trips.id', function ($query) use($originCityId) {
                    $query->select('trip_id')
                          ->from('trips_cities')
                          ->where('trips_cities.city_id', $originCityId)->get();
                 })
                 ->whereIn('trips.id', function ($query) use($destinationCityId) {
                    $query->select('trip_id')
                          ->from('trips_cities')
                          ->where('trips_cities.city_id', $destinationCityId)->get();
                 })
                 ->where(function($query) use ($date, $originCityId, $destinationCityId){
                    $query->WhereNull('reservations.id')
                          ->orwhere('reservations.date', '<>', $date);
                 })
                 ->get(['seats.id',
                        'seats.row',
                        'seats.column',
                        'trip_dates.trip_id',
                        'destination_trip_city.stop as reservation_destination_stop',
                        'destination_trip_city.stop as reservation_origin_stop',
                        DB::raw("(SELECT stop from trips_cities where trip_id = trip_dates.trip_id and city_id=$destinationCityId) as destination_stop"),
                        DB::raw("(SELECT stop from trips_cities where trip_id = trip_dates.trip_id and city_id=$originCityId) as origin_stop"),
                        DB::raw('trip_dates.id AS trip_date_id'),
                        'trip_dates.time']);

        $seats = $seats->filter(function ($item) {
            return $item->destination_stop > $item->origin_stop
                &&  ($item->reservation_destination_stop === NULL
                    || $item->origin_destination_stop === NULL
                    || $item->reservation_destination_stop < $item->origin_stop 
                    || $item->reservation_origin_stop < $item->destination_stop);
        });

        return $seats;
    }
}
