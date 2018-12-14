<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PointOfSaleServiceStation::class, function (Faker $faker) {
//    $s = (FactoryHelper::getOrCreate(\App\PointOfSaleService::class))->id;
    $st = (FactoryHelper::getOrCreate(\App\Station::class));
    $s = $st->point_of_sale->point_of_sale_services->random()->id;



    return [
        //
        'point_of_sale_service_id'=>$s,
        'station_id'=>$st->id,
    ];
});
