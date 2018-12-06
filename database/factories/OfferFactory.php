<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {


    $s = (FactoryHelper::getOrCreate(\App\Service::class))->id;
    $c = $faker->randomLetter.$faker->randomLetter;

    return [
        //
        'name'=>$faker->name,
        'code'=>$c,
        'amount'=>$faker->randomNumber(5),
        'service_id'=>$s,
    ];
});
