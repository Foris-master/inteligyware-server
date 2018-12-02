<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\ServiceStation::class, function (Faker $faker) {
    $s = (FactoryHelper::getOrCreate(\App\Service::class))->id;
    $st = (FactoryHelper::getOrCreate(\App\Station::class))->id;



    return [
        //
        'service_id'=>$s,
        'station_id'=>$st,
    ];
});
