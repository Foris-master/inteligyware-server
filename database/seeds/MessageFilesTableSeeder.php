<?php

use Illuminate\Database\Seeder;

class MessageFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\MessageFile::class,5)->create();

    }
}
