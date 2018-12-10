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

use App\Helpers\FactoryHelper;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $p = FactoryHelper::getOrCreate(\App\Patner::class)->id;
    $d = null;
    $s =array_random(\App\User::$Status);
    $a = $faker->boolean(40)?(FactoryHelper::getOrCreate(\App\Address::class))->id:null;

    return [
        'email' => $faker->unique()->safeEmail,
        'phone_number'=>$faker->phoneNumber,
        'failed_password_attemps'=>$faker->numberBetween(0,3),
        'is_active'=>$faker->boolean(80),
        'status'=>$s,
        'password' => $password ?: $password = bcrypt('password'),
        'patner_id'=>$p,
        'last_device_id'=>$d,
        'last_login'=>$faker->dateTime(),
        'address_id'=>$a,
        'remember_token' => str_random(10),
        'settings'=>''
    ];
});
