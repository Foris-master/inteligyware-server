<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Patner::class, function (Faker $faker) {
    $a = (FactoryHelper::getOrCreate(\App\Address::class))->id;
    $s = array_random(\App\Patner::$Status);
    $l = FactoryHelper::fakeFile($faker,'patners/logo');

    return [
        //
        'name'=>$faker->name,
        'email'=>$faker->email,
        'phone_number'=>$faker->phoneNumber,
        'logo'=>$l,
        'address_id'=>$a,
        'is_active'=>$faker->boolean(),
        'status'=>$s,
    ];
});
