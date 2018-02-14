<?php

use App\Models\Inventary\Brand;
use App\Models\Tatuco\User;

;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(Brand::class, function(Faker $faker){
   return [
       'code' => 'B -'.$faker->randomNumber(5),
       'title'=> $faker->name,
       'description' => $faker->name,
       'created_at'=> new DateTime,
        'updated_at'=> new DateTime
   ];
});
