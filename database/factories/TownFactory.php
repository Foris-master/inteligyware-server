<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Town::class, function (Faker $faker) {
    $co = (FactoryHelper::getOrCreate(\App\Country::class))->id;
    $c = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter;
    return [
        //
        'name'=>$faker->city,
        'code'=>$c,
        'country_id'=>$co
    ];
});
