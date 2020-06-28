<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Retrieves trips for this city
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trips()
    {
        return $this->belongsToMany(Trip::class, 'trips_cities');
    }
}
