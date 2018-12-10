<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('logo');
            $table->string('phone_number');
            $table->integer('address_id')->unsigned()->index();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->string('status',15)->default('inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patners');
    }
}
