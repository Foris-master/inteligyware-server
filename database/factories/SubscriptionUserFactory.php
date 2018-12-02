<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\SubscriptionUser::class, function (Faker $faker) {
    $p = (FactoryHelper::getOrCreate(\App\Patner::class))->id;
    $s = (FactoryHelper::getOrCreate(\App\Subscription::class));
   // $pm = (FactoryHelper::getOrCreate(\App\PaymentMethod::class,false,['patner_id'=>$p]));
    $a = 4*$s->max_amount/5;
    $n = $s->max_transaction-1;

    return [
        //
        'auto_renew'=>$faker->boolean(20),
        'is_valid'=>$faker->boolean(20),
        'remaining_amount'=>$a,
        'remaining_transaction'=>$n,
        'subscription_date'=>$faker->dateTimeBetween('-14 days','2 days'),
        'expiration_date'=>$faker->dateTimeBetween('7 days','30 days'),
        'patner_id'=>$p,
        'subscription_id'=>$s->id,
       // 'payment_method_id'=>$pm->id
    ];
});
