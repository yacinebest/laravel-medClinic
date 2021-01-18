<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PrescriptionLine;
use Faker\Generator as Faker;

$factory->define(PrescriptionLine::class, function (Faker $faker) {
    return [
        'medicine'=>'Paracétamol 1000 mg',
        'dose'=>'1 Comprimé',
        'time_taken'=>'Matin et Soir',
        'duration'=>'3 Jour'
    ];
});
