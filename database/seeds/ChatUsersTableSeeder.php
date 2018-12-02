<?php

use Illuminate\Database\Seeder;

class ChatUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\ChatUser::class,15)->create();

    }
}
