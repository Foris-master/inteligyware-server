<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {


    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;
    $t = (FactoryHelper::getOrCreate(\App\Town::class))->id;



    return [
        //
        'name'=>$faker->address,

        'user_id'=>$u,
        'town_id'=>$t,
    ];
});
