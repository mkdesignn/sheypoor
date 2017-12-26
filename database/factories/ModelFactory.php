<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

    $type = ["admin", "user", "editor"];
    $type_selected = array_rand($type);

//   $role = \App\Role::get()->shuffle()->first();

    $sex = ["male", "female"];
    $sex_selected = array_rand($sex);
    return [
        'name' => $faker->name,
        'family' => $faker->lastName,
        'email' => $faker->email,
        'username' => $faker->userName,
        'password' => $faker->password(6, 15),
        'type' => $type[$type_selected],
        'role_id' => 8,
        'sex' => $sex[$sex_selected],
        'avatar' => $faker->imageUrl(400, 300),
        'status' => 1,
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Motorbike::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'model' => $faker->name,
        'weight' => $faker->numberBetween(1000, 5000),
        'price' => $faker->numberBetween(2000000, 10000000),
        'color' => $faker->hexColor,
        'image' => $faker->imageUrl(),
    ];
});