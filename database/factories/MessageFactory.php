<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {

    $cui = FactoryHelper::getOrCreate(\App\ChatUser::class)->id;

    $s =array_random(\App\Message::$Status);
    $t =array_random(\App\Message::$Types);


    return [
        //
        'body'=>$faker->text,
        'chat_user_id'  => $cui,
        'type'=>$t,
        'status'=>$s,
    ];
});
