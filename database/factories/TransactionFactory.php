<?php

use App\Helpers\FactoryHelper;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $u = (FactoryHelper::getOrCreate(\App\User::class))->id;
    $ps = (FactoryHelper::getOrCreate(\App\PointOfSaleService::class));
    $o= $ps->service->offers()->get()->random();

    $s = array_random(\App\Transaction::$Status);
    $a = $o->amount==0 ?  $faker->randomNumber(3) : $o->amount;
   // $c = FactoryHelper::getOrCreateMorph([\App\Offer::class]);

    $tab = \App\Transaction::$Targets;
    if($ps->service->code!='cs'&&$ps->service->code!='cs'){
        $cc = 0;
    }else{
        $cc = 1;
    }
//    $cc=$faker->numberBetween(0,count($tab)-1);
    $t = FactoryHelper::getOrCreate($tab[$cc])->id;




    return [
        //
        'amount'=>$a,
        'status'=>$s,
        'user_id'=>$u,
        'offer_id'=>$o->id,
        'target_id'=>$t,
        'target_type'=>$tab[$cc],
        'point_of_sale_service_id'=>$ps->id,
    ];
});
