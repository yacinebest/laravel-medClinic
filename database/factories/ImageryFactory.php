<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Imagery;
use Faker\Generator as Faker;

$factory->define(Imagery::class, function (Faker $faker) {
    return [
        'file'=>'image.jpg'
    ];
});
