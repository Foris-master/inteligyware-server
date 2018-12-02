<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Station::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Patner::class))->id;
    $m = (FactoryHelper::getOrCreate(\App\MobileOperator::class))->id;



    return [
        //
        'name'=>$faker->name,
        'bail'=>$faker->randomNumber(6),
        'patner_id'=>$p,
        'mobile_operator_id'=>$m,
    ];
});
