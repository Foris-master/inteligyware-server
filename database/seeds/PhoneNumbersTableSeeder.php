<?php

use Illuminate\Database\Seeder;

class PhoneNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\PhoneNumber::class,10)->create();
    }
}
