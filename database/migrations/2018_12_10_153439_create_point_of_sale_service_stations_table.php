<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointOfSaleServiceStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_of_sale_service_stations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('point_of_sale_service_id')->unsigned()->index();
            $table->foreign('point_of_sale_service_id')->references('id')->on('point_of_sale_services')->onDelete('cascade');
            $table->integer('station_id')->unsigned()->index();
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->unique(['point_of_sale_service_id','station_id'],'pointstations_point_of_sale_service_id_station_id_unique');
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
        Schema::dropIfExists('point_of_sale_service_stations');
    }
}
