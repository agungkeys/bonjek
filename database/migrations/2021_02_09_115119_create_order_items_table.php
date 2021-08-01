<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_items', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('order_id')->unsigned();
      $table->string('invoice_id');
      $table->bigInteger('product_id')->unsigned();
      $table->integer('quantity');
      $table->integer('price');
      $table->integer('weight')->nullable();
      $table->string('weight_type')->nullable();
      $table->integer('status')->nullable();
      $table->timestamps();
    });

    Schema::table('order_items', function (Blueprint $table) {
      $table->foreign('order_id')->references('id')->on('orders');
      $table->foreign('product_id')->references('id')->on('products');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('order_items');
  }
}
