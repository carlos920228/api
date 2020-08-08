<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\corporation;
use App\corporation_phones;
use App\Tw_rol;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(corporation::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'web' => $faker->url,
    ];
});
$factory->define(corporation_phones::class, function (Faker $faker) {
    return [
        'number' =>$faker->unique()->numerify($string = '############'),
        'S_Tipo'=>'Celular',
        'corporation_id' => corporation::inRandomOrder()->first()->id,
    ];
});
$factory->define(Tw_rol::class, function (Faker $faker) {
    return [
        'S_Nombre' =>$faker->firstname(),
        'S_MenuBgColor'=>$faker->hexcolor(),
        'S_MenuBgImageUrl' =>$faker->imageUrl(),
        'N_Activo'=>1,
    ];
  });
  $factory->define(User::class, function (Faker $faker) {
    static $password;
        return [

          'name'=>$faker->name,
          'email'=> $faker->unique()->safeEmail,
          'D_UltimaSesion'=>$faker->dateTime(),
          'remember_token'=>Str::random(10),
          'password'=> $password ?: $password= bcrypt('secret'),
          'N_Activo'=>1,
          'tw_rol_id'=> Tw_rol::inRandomOrder()->first()->id,
          'corporation_id'=> corporation::inRandomOrder()->first()->id,
        ];
});
