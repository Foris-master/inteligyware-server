<?php

use Illuminate\Database\Seeder;

class CreditCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\CreditCard::class,40)->create();
    }
}
