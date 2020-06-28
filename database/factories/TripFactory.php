<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Trip;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'name' => 'Trip '. $faker->unique()->randomNumber(4),
    ];
});
