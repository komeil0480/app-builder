<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Component;
use Faker\Generator as Faker;

$factory->define(Component::class, function (Faker $faker) {
    return [
        'type'=>'button',
        'id_comp'=>2,
    ];
});
