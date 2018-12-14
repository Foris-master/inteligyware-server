<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    $b = (FactoryHelper::getOrCreate(\App\Bill::class));
    $c = (FactoryHelper::getOrCreate(\App\Currency::class))->id;
    $s = array_random(\App\Payment::$Status);


    //$pm = (FactoryHelper::getOrCreate(\App\PaymentMethod::class,true, ["patner_id"=>$b->patner_id]))->id;

    $amount = $faker->randomNumber(5);
    $k1 = $faker->boolean(75);
    $ap = $k1 ? $amount: 4*$amount/5;

    $p = FactoryHelper::fakeFile($faker,'payments/proof');


    return [
        //
        'amount'=>$amount,
        'status'=>$s,
        'amount_paid'=>$ap,
        'reference'=>$faker->buildingNumber,
        'proof'=>$p,
        'payment_date'=>  $faker->dateTimeBetween('-10 days','now'),
        'matching_payment_date'=>  $faker->dateTimeBetween('-10 days','now'),
       // 'payment_method_id'=> $pm,
        'currency_id'=>$c,
        'bill_id'=>$b
    ];
});
