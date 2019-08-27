<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

use Carbon\Carbon;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name'=>$faker->title,
        'created_at' => Carbon::now()->format('Y-m-d'),
    	'updated_at' => Carbon::now()->format('Y-m-d'),
    ];
});
