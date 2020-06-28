<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Retrieves trip buses
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function buses()
    {
        return $this->belongsToMany(Bus::class, 'trips_buses');
    }

    /**
     * Retrieves trip cities
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cities()
    {
        return $this->belongsToMany(City::class, 'trips_cities')->withPivot('stop');;
    }

    /**
     * Retrieves trip dates
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dates()
    {
        return $this->hasMany(TripDate::class);
    }
}
