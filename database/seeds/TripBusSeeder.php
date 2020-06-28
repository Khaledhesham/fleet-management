<?php

use App\Bus;
use App\Trip;
use Illuminate\Database\Seeder;

class TripBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = Trip::all();

        $bus = Bus::first();

        foreach ($trips as $trip)
        {
            DB::table('trips_buses')->insert(
                [
                    'trip_id' => $trip->id,
                    'bus_id' => $bus->id
                ]
            );
        }
    }
}
