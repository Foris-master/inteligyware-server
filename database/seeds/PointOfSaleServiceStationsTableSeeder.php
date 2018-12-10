<?php

use Illuminate\Database\Seeder;

class PointOfSaleServiceStationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //        factory(\App\PointOfSaleService::class,10)->create();
        \App\Helpers\FactoryHelper::force_seed(\App\PointOfSaleServiceStation::class,5);

    }
}
