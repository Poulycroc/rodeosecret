<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

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

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = Hash::make('secret'), // bcrypt
        'remember_token' => Str::random(10),
    ];
});
