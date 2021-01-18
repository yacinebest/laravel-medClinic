<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Prescription;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Prescription::class, function (Faker $faker) {
    return [
        'date'=>Carbon::now()->format('Y-m-d'),
    ];
});
