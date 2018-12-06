<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    $c = $faker->randomLetter.$faker->randomLetter;
    $l = FactoryHelper::fakeFile($faker,'services/logo');

    return [
        //
        'name'=>$faker->name,
        'code'=>$c,
        'logo'=>$l,
        'description'=>$faker->text(),
    ];
});
