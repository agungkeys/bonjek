<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  //
  protected $fillable = [
    'invoice_id',
    'customer_id',
    'district_shipping_charges_id',
    'shipping_charge',
    'admin_fee',
    'total_price',
    'status',
  ];
  protected $guarded = ['invoice_id'];
}
