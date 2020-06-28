<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            TripDateSeeder::class,
            TripCitySeeder::class,
            BusSeeder::class,
            SeatSeeder::class,
            TripBusSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
