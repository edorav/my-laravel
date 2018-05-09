<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TripDay::class, function (Faker $faker) {
    $randomTripId = App\Models\Trip::inRandomOrder()->get()->first()->id;
    $randomCityId = App\Models\City::inRandomOrder()->get()->first()->id;

    return [
        //
        'trip_id' => $randomTripId,
        'city_id' => $randomCityId,
        'from' => $faker->date,
        'to' => $faker->date,

    ];
});
