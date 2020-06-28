<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function getAvailableSeats(Carbon $date, int $originCityId, int $destinationCityId)
    {
        $seats = DB::table('seats')
                 ->join('buses', 'buses.id', '=', 'seats.bus_id')
                 ->join('trips_buses', 'trips_buses.bus_id', '=', 'buses.id')
                 ->join('trips', 'trips.id', '=', 'trip_buses.trip_id')
                 ->whereExists(function ($query) use($originCityId) {
                    $query->select(DB::raw(1))
                          ->from('trips_cities')
                          ->where('trips_cities.trip_id', 'trips.id')
                          ->where('trips_cities.city_id', $originCityId);
                 })
                 ->whereExists(function ($query) use($destinationCityId) {
                    $query->select(DB::raw(1))
                          ->from('trips_cities')
                          ->where('trips_cities.trip_id', 'trips.id')
                          ->where('trips_cities.city_id', $destinationCityId);
                 })
                 ->join('trips_dates', 'trips.id', '=', 'trips_dates.trip_id')
                 ->where('trips_dates.weekday', $date->dayOfWeek)
                 ->leftJoin('reservations', 'seats.id', '=', 'reservations.seat_id')
                 ->join('trips_cities as origin_trip_cities', 'reservations.origin_city_id', '=' , 'origin_trip_cities.city_id')
                 ->join('trips_cities as destination_trip_cities', 'reservations.origin_city_id', '=' , 'destination_trip_cities.city_id')
                 ->where('reservations.date', $date)
                 ->where(function(Builder $query) use ($originCityId, $destinationCityId){
                    $query->WhereNull('reservations.id')->orwhere(function(Builder $query) use ($originCityId, $destinationCityId)
                    {
                    $query->where('origin_trip_cities.stop', '>=',
                                DB::Raw("`SELECT stop from trips_cities where trip_id=trips.id and city_id=$destinationCityId`"))
                            ->orWhere('destination_trip_cities.stop', '<=',
                                DB::Raw("`SELECT stop from trips_cities where trip_id=trips.id and city_id=$originCityId`"));
                    });
                 })->get('seats.id', 'seats.row', 'seats.column', 'trip_dates.id');

        return $seats;
    }
}
