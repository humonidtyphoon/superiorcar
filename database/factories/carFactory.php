<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Models\Car;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'post_title' => $this->faker->sentence, //Generates a fake sentence
        'post_content' => $this->faker->paragraph(30), //generates fake 30 paragraphs
        //etc
        
    ];
});
