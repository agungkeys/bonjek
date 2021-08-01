<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  //
  protected $fillable = [
    'name',
    'description',
    'user_id',
    'price',
    'discount',
    'stock',
    'weight_variant',
    'weight',
    'store_id',
    'product_category_id',
    'product_sub_category_id',
    'slug',
    'status',
  ];

  public function path() {
    return "/merchant-product/{$this->slug}";
  }

  public function images() {
  	return $this->hasMany('App\ProductImages');
  }

  public function user() {
  	return $this->belongsTo('App\User');
  }

  public function store() {
  	return $this->hasOne('App\Store');
  }

  public function thumbnailUrl() {
    $first_image = $this->images->first();
    return $first_image ? $first_image->url : '';
  }

  public function category() {
    return $this->belongsTo('App\ProductCategories');
  }

  public function vendor() {
    $store_name = $this->user->store->name;
    $vendor    = $store_name ? $store_name : $this->user->name;

    return $vendor;
  }

  public function vendor_url() {
    $store_id = $this->user->store->id;
    $url     = $store_id ? route('store.show', $store_id) : null;

    return $url;
  }
}
