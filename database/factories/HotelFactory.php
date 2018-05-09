<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Hotel::class, function (Faker $faker) {

    $randomCityId = App\Models\City::inRandomOrder()->get()->first()->id;

    return [
        //
        'name' => $faker->company,
        'address' => $faker->address,
        'city_id' => $randomCityId,
        'postcode' => $faker->postcode,
        'stars' => rand(1,5)
    ];
});
