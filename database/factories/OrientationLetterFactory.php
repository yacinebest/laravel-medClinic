<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrientationLetter;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(OrientationLetter::class, function (Faker $faker) {
    return [
        'date'=>Carbon::now()->format('Y-m-d'),
        'content'=>$faker->text()
    ];
});
