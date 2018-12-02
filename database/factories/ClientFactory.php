<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Patner::class))->id;
    $t = $faker->boolean(20)?'vip':'standard';

    return [
        //
        'name'=>$faker->name,
        'email'=>$faker->email,
        'phone_number'=>$faker->phoneNumber,
        'type'=>$t,
        'patner_id'=>$p,
    ];
});
