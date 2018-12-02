<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Chat::class, function (Faker $faker) {
    $tab = [\App\Community::class,\App\Offer::class];
    $cc=$faker->numberBetween(0,count($tab)-1);
    $c = FactoryHelper::getOrCreate($tab[$cc])->id;

    return [
        //
        'title'=>$faker->jobTitle,
        'concern_id'  => $c,
        'concern_type'=>$tab[$cc]
    ];
});
