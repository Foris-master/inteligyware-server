<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\ClientOffer::class, function (Faker $faker) {
    $c = (FactoryHelper::getOrCreate(\App\Client::class))->id;
    $o = (FactoryHelper::getOrCreate(\App\Offer::class))->id;



    return [
        //
        'client_id'=>$c,
        'offer_id'=>$o,
    ];
});
