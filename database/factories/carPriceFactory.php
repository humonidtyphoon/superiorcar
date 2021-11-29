<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Models\CarPrice;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'available' => $this->faker->sentence, //Generates a fake sentence
        'start_time' => \Carbon\Carbon::now(),
        'end_time' => \Carbon\Carbon::now(),
        'ID' => CarPrice::factory() //Generates a carPrice from factory and extracts ID
    ];
});
