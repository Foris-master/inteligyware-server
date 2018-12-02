<?php

use Illuminate\Database\Seeder;

class ClientOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\ClientOffer::class,30)->create();
        \App\Helpers\FactoryHelper::force_seed(\App\ClientOffer::class,20);

    }
}
