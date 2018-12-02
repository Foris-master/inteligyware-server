<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        factory(\App\Payment::class,10)->create();
        \App\Helpers\FactoryHelper::force_seed(\App\Payment::class,10);

    }
}
