<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PointOfSaleServiceStation::class, function (Faker $faker) {
    $s = (FactoryHelper::getOrCreate(\App\PointOfSaleService::class))->id;
    $st = (FactoryHelper::getOrCreate(\App\Station::class))->id;



    return [
        //
        'point_of_sale_service_id'=>$s,
        'station_id'=>$st,
    ];
});
