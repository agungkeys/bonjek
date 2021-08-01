<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('user_id');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('stock')->nullable();
            $table->string('weight_variant')->nullable();
            $table->integer('weight')->nullable();
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('product_category_id')->unsigned();
            $table->bigInteger('product_sub_category_id')->unsigned();
            $table->string('slug');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function (Blueprint $table) {
          $table->foreign('store_id')->references('id')->on('stores');
          $table->foreign('product_category_id')->references('id')->on('product_categories');
          $table->foreign('product_sub_category_id')->references('id')->on('product_sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
