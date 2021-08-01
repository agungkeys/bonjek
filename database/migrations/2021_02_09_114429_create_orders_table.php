<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('invoice_id');
      $table->integer('customer_id')->unsigned();
      $table->bigInteger('district_shipping_charges_id')->unsigned();
      $table->integer('shipping_charge');
      $table->integer('admin_fee');
      $table->integer('total_price');
      $table->integer('billing_id')->nullable();
      $table->integer('status')->nullable();
      $table->timestamps();
    });

    Schema::table('orders', function (Blueprint $table) {
      $table->foreign('customer_id')->references('id')->on('users');
      $table->foreign('district_shipping_charges_id')->references('id')->on('district_shipping_charges');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('orders');
  }
}
