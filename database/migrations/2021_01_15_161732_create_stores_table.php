<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('slug');
          $table->text('description');
          $table->string('user_id')->unique();
          $table->bigInteger('store_category_id')->unsigned();
          $table->bigInteger('district_id')->unsigned();
          $table->bigInteger('city_id')->unsigned();
          $table->bigInteger('popular')->unsigned();
          $table->text('address')->nullable();
          $table->string('store_open');
          $table->string('store_close');
          $table->string('telp')->nullable();
          $table->string('original')->nullable();
          $table->string('small')->nullable();
          $table->string('medium')->nullable();
          $table->string('large')->nullable();
          $table->string('extra_large')->nullable();
          $table->string('status')->nullable();
          $table->timestamps();
        });

        Schema::table('stores', function (Blueprint $table) {
          $table->foreign('store_category_id')->references('id')->on('store_categories')->onDelete('cascade');
          $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
          $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
