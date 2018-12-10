<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PointOfSaleService::class, function (Faker $faker) {
    $s = (FactoryHelper::getOrCreate(\App\Service::class))->id;
    $ps = (FactoryHelper::getOrCreate(\App\PointOfSale::class))->id;

    return [
        //
        'service_id'=>$s,
        'point_of_sale_id'=>$ps,
    ];
});
