<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Patient;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'email'=>$faker->email,

        'social_security_number'=>'',
        'birth_date'=>$faker->date(),
        'phone_number'=>$faker->phoneNumber,
        'address'=>$faker->address,
        'chronic_diseases'=>'',
        'allergies'=>'',
        'antecedents'=>'',
        'comments'=>''
    ];
});
