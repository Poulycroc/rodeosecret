<?php

use Faker\Generator as Faker;

use App\Models\Competition;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Competition::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'start_event' => $faker->dateTime($min = 'now', $timezone = null),
        'description' => $faker->text,
        'category_id' => 1,
    ];
});
