<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    $c = $faker->randomLetter.$faker->randomLetter;

    return [
        //
        'name'=>$faker->name,
        'code'=>$c,
        'description'=>$faker->text(),
    ];
});
