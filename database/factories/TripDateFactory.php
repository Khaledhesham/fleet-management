<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TripDate;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(TripDate::class, function (Faker $faker) {
    return [
        'trip_id' => factory(App\Trip::class),
        'weekday' => Carbon::parse($faker->date())->dayOfWeek,
        'time' => $faker->time(),
        'is_recurring' => $faker->boolean(),
    ];
});
