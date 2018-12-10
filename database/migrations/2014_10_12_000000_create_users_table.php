<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cni');
            $table->string('picture');
            $table->integer('failed_password_attemps')->default(0);
            $table->boolean('is_active')->default(false);
            $table->string('status')->default('inactive');
            $table->string('password');
            $table->integer('address_id')->unsigned()->index()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->integer('patner_id')->unsigned()->index()->nullable();
            $table->foreign('patner_id')->references('id')->on('patners')->onDelete('set null');

            $table->integer('last_device_id')->unsigned()->index()->nullable();
            // because of circular dependency we will not create the foreign relation
//            $table->foreign('last_device_id')->references('id')->on('devices')->onDelete('set null');
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
