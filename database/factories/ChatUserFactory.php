<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\ChatUser::class, function (Faker $faker) {
    $c = (FactoryHelper::getOrCreate(\App\Chat::class))->id;
    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;

    return [
        //
        'is_admin'=>$faker->boolean(30),
        'chat_id'=>$c,
        'user_id'=>$u,
    ];
});
