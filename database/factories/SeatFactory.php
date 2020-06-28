<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bus;
use App\Seat;
use Faker\Generator as Faker;

$factory->define(Seat::class, function (Faker $faker) {
    $bus_id = Bus::first()->id;
    return [
        'bus_id' => $bus_id,
        'row' => $faker->randomNumber(1),
        'column' => $faker->randomNumber(1),
    ];
});
