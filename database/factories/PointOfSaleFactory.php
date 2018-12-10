<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PointOfSale::class, function (Faker $faker) {
    $a = (FactoryHelper::getOrCreate(\App\Address::class))->id;
    $p = (FactoryHelper::getOrCreate(\App\Patner::class))->id;
    $l = FactoryHelper::fakeFile($faker,'point_of_sales/picture');

    return [
        //
        'name'=>$faker->name,
        'picture'=>$l,
        'patner_id'=>$p,
        'address_id'=>$a,
    ];
});
