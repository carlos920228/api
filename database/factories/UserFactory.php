<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\corporation;
use App\corporation_phones;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(corporation::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'web' => $faker->domainName,
    ];
});
$factory->define(corporation_phones::class, function (Faker $faker) {
    return [
        'number' =>$faker->unique()->numerify($string = '############'),
        'S_Tipo'=>'Celular',
        'corporation_id' => corporation::inRandomOrder()->first()->id,
    ];
});
