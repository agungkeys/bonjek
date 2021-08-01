<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
  //
  protected $fillable = [
    'order_id',
    'invoice_id',
    'product_id',
    'quantity',
    'price',
    'weight',
    'weight_type',
    'status',
  ];
  protected $guarded = ['order_id', 'invoice_id'];
}
