<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Subscription::class, function (Faker $faker) {

    $c = (FactoryHelper::getOrCreate(\App\Currency::class))->id;
    $t = $faker->boolean()?'m':'y';
    $co = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter;
    return [
        //
        'code'=>$co,
        'name'=>$faker->name,
        'price'=>$faker->randomFloat(2),
        'type'=>$t,
        'currency_id'=>$c,
        'description'=>$faker->text(),
        'max_amount'=>$faker->randomFloat(2,1000,1000000),
        'max_transaction'=>$faker->numberBetween(3,10)
    ];
});
