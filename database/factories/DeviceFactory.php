<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Device::class, function (Faker $faker) {
    $t=array_random(\App\Device::$Types);
    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;

    return [
        //
        'name' => $faker->name,
        'tag' => $faker->unique(),
        'type'=>$t,
        'description'=>$faker->text(),
        'user_id'=>$u
    ];
});
