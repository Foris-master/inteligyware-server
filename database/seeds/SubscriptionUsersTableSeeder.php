<?php

use Illuminate\Database\Seeder;

class SubscriptionUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\SubscriptionUser::class,20)->create();

    }
}
