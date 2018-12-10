<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {


    $t = (FactoryHelper::getOrCreate(\App\Town::class))->id;



    return [
        //
        'name'=>$faker->address,
        'town_id'=>$t,
    ];
});
