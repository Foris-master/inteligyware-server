<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;
    $s = array_random(\App\Transaction::$Status);
    $c = FactoryHelper::getOrCreateMorph([\App\Offer::class]);




    return [
        //
        'amount'=>$faker->randomNumber(3),
        'status'=>$s,
        'user_id'=>$u,
        'concern_type'=>get_class($c),
        'concern_id'=>$c->id
    ];
});
