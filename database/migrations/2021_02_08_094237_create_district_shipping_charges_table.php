<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('origin_id')->unsigned();
            $table->bigInteger('destination_id')->unsigned();
            $table->integer('price');
            $table->integer('goods_price')->nullable();
            $table->integer('special_price')->nullable();
            $table->integer('large_price')->nullable();
            $table->timestamps();
        });

        Schema::table('district_shipping_charges', function (Blueprint $table) {
          $table->foreign('city_id')->references('id')->on('city');
          $table->foreign('origin_id')->references('id')->on('districts');
          $table->foreign('destination_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_shipping_charges');
    }
}
