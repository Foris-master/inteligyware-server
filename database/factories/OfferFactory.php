<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {


    $s = (FactoryHelper::getOrCreate(\App\Service::class))->id;

    return [
        //
        'name'=>$faker->name,
        'amount'=>$faker->randomNumber(5),
        'service_id'=>$s,
    ];
});
