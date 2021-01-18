<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Appointment;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'date'=>Carbon::now()->addDay()->format('Y-m-d'),
        'reason'=>'',
        // $faker->dateTime()->format('Y-m-d H:i:s')
        'start_at'=>Carbon::now()->addDay()->format('Y-m-d H:i:s'),
        'end_at'=>Carbon::now()->addDay()->format('Y-m-d H:i:s'),
    ];
});
