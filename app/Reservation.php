<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Reservation extends Model
{
    protected $fillable = [
        'trip_date_id', 'seat_id', 'user_id', 'origin_city_id', 'destination_city_id', 'date', 
    ];

    /**
     * Retrieves trip date for this reservation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tripDate()
    {
        return $this->belongsTo(TripDate::class);
    }

    /**
     * Retrieves seat for this reservation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    /**
     * Retrieves user for this reservation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieves origin city for this reservation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originCity()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieves destination city for this reservation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationCity()
    {
        return $this->belongsTo(User::class);
    }
}
