<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Agency::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'postcode' => $faker->postcode
    ];
});
