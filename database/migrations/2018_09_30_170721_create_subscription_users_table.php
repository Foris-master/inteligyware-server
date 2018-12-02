<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_valid');
            $table->boolean('auto_renew');
            $table->dateTime('expiration_date');
            $table->dateTime('subscription_date');

            $table->float('remaining_amount');
            $table->integer('remaining_transaction');

            $table->integer('patner_id')->unsigned()->index();
            $table->foreign('patner_id')->references('id')->on('patners')->onDelete('cascade');

            $table->integer('subscription_id')->unsigned()->index();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');

            $table->unique(array('subscription_id', 'patner_id'));
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
        Schema::dropIfExists('subscription_users');
    }
}
