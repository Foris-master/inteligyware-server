<?php
/**
 * Created by PhpStorm.
 * User: evari
 * Date: 8/18/2018
 * Time: 12:03 PM
 */

use App\Helpers\FactoryHelper;
use App\Rating;
use App\User;

$factory->define(Rating::class, function (Faker\Generator $faker) {

    $tab = [\App\Patner::class,\App\User::class];
    $rn=$faker->numberBetween(0,count($tab)-1);
    $r = FactoryHelper::getOrCreate($tab[$rn])->id;
    $u = FactoryHelper::getOrCreate(User::class)->id;
    $n=$faker->numberBetween(0,5);

    return [
        'ratingable_id'  => $r,
        'ratingable_type'=>$tab[$rn],
        'author_id'  => $u,
        'author_type'=>User::class,
        'rating' =>$n
    ];
});