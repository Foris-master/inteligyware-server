<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Station::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\PointOfSale::class))->id;
    $m = (FactoryHelper::getOrCreate(\App\MobileOperator::class))->id;



    return [
        //
        'name'=>$faker->name,
        'bail'=>$faker->randomNumber(6),
        'point_of_sale_id'=>$p,
        'mobile_operator_id'=>$m,
    ];
});
