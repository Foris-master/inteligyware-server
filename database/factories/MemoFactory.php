<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Memo::class, function (Faker $faker) {
    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;
    return [
        //
        'content'=>$faker->text(),
        'user_id'=>$u
    ];
});
