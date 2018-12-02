<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\MobileOperator::class, function (Faker $faker) {
    $l = FactoryHelper::fakeFile($faker,'mobile_operators/logo');
    $co = (FactoryHelper::getOrCreate(\App\Country::class))->id;
    $c = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter;
    return [
        //
        'name'=>$faker->company,
        'code'=>$c,
        'logo' => $l,
        'country_id' => $co
    ];
});
