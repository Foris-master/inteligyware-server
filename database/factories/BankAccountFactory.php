<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\BankAccount::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Person::class))->id;
    $c = (FactoryHelper::getOrCreate(\App\Currency::class))->id;

    return [
        //
        'number'=>$faker->bankAccountNumber,
        'bank_name' => $faker->company,
        'bank_address' => $faker->address,
        'swift_code' => $faker->swiftBicNumber,
        'person_id' => $p,
        'currency_id' => $c
    ];
});
