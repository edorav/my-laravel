<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    $randomTripDayId = App\Models\TripDay::inRandomOrder()->get()->first()->id;
    $randomUserId = App\Models\User::inRandomOrder()->get()->first()->id;

    return [
        //
        'content' => $faker->text,
        'tripday_id' => $randomTripDayId,
        'user_id' => $randomUserId
    ];
});
