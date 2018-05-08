<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Trip::class, function (Faker $faker) {
    $randomUserId = App\Models\User::inRandomOrder()->get()->first()->id;

    return [
        //
        'label' => 'Trip to ' . $faker->city,
        'user_id' => $randomUserId
    ];
});
