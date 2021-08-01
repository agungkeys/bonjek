<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
  //

  protected $fillable = [
    'name',
    'slug',
    'description',
    'user_id',
    'store_category_id',
    'district_id',
    'city_id',
    'popular',
    'address',
    'store_open',
    'store_close',
    'telp',
    'original',
    'small',
    'medium',
    'large',
    'extra_large',
    'status'
  ];
  protected $guarded = ['store_category_id'];

  public const UPLOAD_DIR = 'images';

  public const SMALL = '141x141';
	public const MEDIUM = '400x400';
	public const LARGE = '656x656';
	public const EXTRA_LARGE = '1200x1200';

  public function path(){
    return "/stores/{$this->id}";
  }

  public function user(){
    return $this->belongsTo('App\User')->withDefault();
  }

  public function storeCategory()
  {
    return $this->belongsTo('App\StoreCategories');
  }

  public function district()
  {
    return $this->belongsTo('App\District');
  }

  public function city()
  {
    return $this->belongsTo('App\City');
  }

  public function product() {
  	return $this->hasMany('App\Product');
  }
}
