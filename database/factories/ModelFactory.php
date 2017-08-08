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
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'codebar' => str_random(10),
        'used' => random_int(0,1),
        'name' => str_random(15),
        'original_cost' => random_int(1,1000),
        'selling_price' => random_int(1,5000),
        'min_qty' => random_int(0,20),
        'max_qty' => random_int(20,50),
        'deposit' => random_int(0, 100) / 100,
        'allow_notif' => random_int(0,1),
        'qty' => random_int(1,50),
        'category_id' => random_int(1,27),
        'bonidollar' => random_int(0,1),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()



    ];
});
