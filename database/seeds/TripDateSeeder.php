<?php

use App\TripDate;
use Illuminate\Database\Seeder;

class TripDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TripDate::class, 1000)->create();
    }
}
