<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripDate extends Model
{
    protected $fillable = [
        'trip_id', 'weekday', 'time', 'is_recurring'
    ];

    /**
     * Retrieves trips for this city
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
