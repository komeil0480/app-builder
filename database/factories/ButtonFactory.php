<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Button;
use Faker\Generator as Faker;

$factory->define(Button::class, function (Faker $faker) {
    return [
        'text'=>$faker->title,
        'target'=>$faker->title,
        'page_id'=>$faker->id,
    ];
});
