<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\Resto::class, function (Faker\Generator $faker) {


    return [
        'name' => $faker->name,
        'genre' => $faker->word,
        'pricing' => $faker->word,
        'address' => $faker->streetAddress,
        'city'=> $faker->city,
        'postalcode' => $faker->postcode,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'addedBy' => $faker->randomNumber()
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {


    return [
        'title' => $faker->title,
        'content' => $faker->text,
        'user' => $faker->numberBetween(1,50),
        'resto' => $faker->numberBetween(52,100),
        'rating' => $faker->numberBetween(1,5)
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {


    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password(6,20),
        'postalcode' => $faker->postcode
    ];
});