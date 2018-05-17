<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TripUser::class, function (Faker $faker) {
    $randomTripId = App\Models\Trip::inRandomOrder()->get()->first()->id;
    $randomUserId = App\Models\User::inRandomOrder()->get()->first()->id;

    return [
        //
        'trip_id' => $randomTripId,
        'user_id' => $randomUserId

    ];
});
