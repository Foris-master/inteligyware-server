<?php

use Illuminate\Database\Seeder;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Bill::class,10)->create();
        \App\Helpers\FactoryHelper::force_seed(\App\Bill::class,4);
    }
}
