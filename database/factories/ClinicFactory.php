<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Clinic;
use Faker\Generator as Faker;

$factory->define(Clinic::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'address'=>$faker->address,
        'phone_number'=>$faker->phoneNumber
    ];
});
