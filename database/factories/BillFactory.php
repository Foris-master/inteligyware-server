<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Bill::class, function (Faker $faker) {


    $tab = [\App\Offer::class,\App\SubscriptionUser::class];
    $cc=$faker->numberBetween(0,count($tab)-1);
    $c = FactoryHelper::getOrCreate($tab[$cc])->id;

    return [
        //
        'amount'=>$faker->randomFloat(3),
        'concern_id'  => $c,
        'concern_type'=>$tab[$cc]
    ];
});
