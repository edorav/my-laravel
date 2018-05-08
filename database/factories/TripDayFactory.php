<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TripDay::class, function (Faker $faker) {
    $randomTripId = App\Models\Trip::inRandomOrder()->get()->first()->id;

    return [
        //
        'city' => $faker->city,
        'trip_id' => $randomTripId,
        'from' => $faker->date,
        'to' => $faker->date,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});
