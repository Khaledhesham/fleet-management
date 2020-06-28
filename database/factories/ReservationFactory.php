<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'trip_date_id' => factory(App\TripDate::class),
        'user_id' => factory(App\City::class),
        'seat_id' => factory(App\City::class),
        'origin_city_id' => factory(App\City::class),
        'destination_city_id' => factory(App\City::class),
        'date' => function (array $reservation) {
            $trip_date = App\TripDate::find($reservation['trip_date_id']);
            $date = Carbon::now();
            $date->subDays($date>dayofweek);
            $date->addDays($trip_date->weekday);
            $date->hour = $trip_date->time->hour;
            $date->minute = $trip_date->time->minute;
            $date->second = $trip_date->time->second;
        },
    ];
});
