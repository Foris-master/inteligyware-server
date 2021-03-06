<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount');
            $table->float('amount_paid');
            $table->string('status',10);
            $table->string('reference');
            $table->string('proof');
            $table->dateTime('payment_date');

            $table->string('pdf');
            $table->integer('currency_id')->unsigned()->index();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->integer('bill_id')->unique()->unsigned()->index();
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');

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
        Schema::dropIfExists('payments');
    }
}
