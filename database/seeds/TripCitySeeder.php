<?php

use App\City;
use App\Trip;
use Illuminate\Database\Seeder;

class TripCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = Trip::all();

        foreach ($trips as $trip)
        {
            $end_stop = rand(2,10);
            for ($stop=1; $stop <= $end_stop; $stop++) { 
                DB::table('trips_cities')->insert(
                    [
                        'trip_id' => $trip->id,
                        'city_id' => City::select('id')->orderByRaw("RAND()")->first()->id,
                        'stop' => $stop
                    ]
                );
            }
        }
    }
}
