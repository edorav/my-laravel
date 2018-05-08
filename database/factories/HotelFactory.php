<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Hotel::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'stars' => rand(1,5)
    ];
});
