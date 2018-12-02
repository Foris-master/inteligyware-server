<?php

use Illuminate\Database\Seeder;

class ServiceStationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\ServiceStation::class,20)->create();
        \App\Helpers\FactoryHelper::force_seed(\App\ServiceStation::class,20);
    }
}
