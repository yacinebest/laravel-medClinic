<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Doctor;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'username'=>$faker->userName,
        'password'=>Hash::make('123456789'),
        'email'=>$faker->email,
        'specialty'=>''
    ];
});
