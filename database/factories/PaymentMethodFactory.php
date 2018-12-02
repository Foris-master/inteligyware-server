<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    $t=array_random(\App\PaymentMethod::$Types);
    $p = (FactoryHelper::getOrCreate(\App\Patner::class))->id;
    $s = FactoryHelper::getOrCreateMorph([\App\PhoneNumber::class,\App\CreditCard::class,\App\BankAccount::class]);

    return [
        //
        'type'=>$t,
        'person_id'=>$p,
        'source_type'=>get_class($s),
        'source_id'=>$s->id
    ];
});
