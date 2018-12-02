<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('bail');
            $table->string('identifier');
            $table->integer('patner_id')->unsigned()->index();
            $table->foreign('patner_id')->references('id')->on('patners')->onDelete('cascade');

            $table->integer('mobile_operator_id')->unsigned()->index();
            $table->foreign('mobile_operator_id')->references('id')->on('mobile_operators')->onDelete('cascade');

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
        Schema::dropIfExists('stations');
    }
}
