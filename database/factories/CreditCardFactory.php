<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\CreditCard::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Person::class))->id;

    return [
        //
        'number'=>$faker->creditCardNumber,
        'type'=>$faker->creditCardType,
        'expired_at'=>$faker->creditCardExpirationDate,
        'person_id'=>$p
    ];
});
