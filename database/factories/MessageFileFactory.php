<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\MessageFile::class, function (Faker $faker) {
    $f = FactoryHelper::fakeFile($faker,'message_files/file');
    $m = (FactoryHelper::getOrCreate(\App\Message::class))->id;

    return [
        //
        'message_id'=>$m,
        'file'=>$f
    ];
});
