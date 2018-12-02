<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PhoneNumber::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Person::class))->id;
    $m = (FactoryHelper::getOrCreate(\App\MobileOperator::class))->id;
    $k = \App\PhoneNumber::wherePersonId($p)->whereIsPrimary(true)->exists();


    return [
        //
        'value'=>$faker->phoneNumber,
        'is_primary'=>!$k,
        'is_verified'=>$faker->boolean(70),
        'has_momo'=>$faker->boolean(60),
        'person_id'=>$p,
        'mobile_operator_id'=>$m
    ];
});
