<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Administrator',
        'username' => 'admin',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'longbak22cute',
        'remember_token' => Str::random(10),
    ];
});



