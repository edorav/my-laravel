<?php

use Faker\Generator as Faker;

$factory->define(App\Models\City::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->city,
        'country' => $faker->country,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});
