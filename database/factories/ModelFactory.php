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

use Faker\Generator as Faker;

$factory->define(App\Domain::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'content_length' => 150,
        'h1' => $faker->text,
        'response_code' => 200,
        'body' => $faker->text,
        'keywords' => $faker->text,
        'description' => $faker->text
    ];
});
