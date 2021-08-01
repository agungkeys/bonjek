<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
  //
  protected $fillable = ['name', 'city_id'];

  public function stores()
  {
  	return $this->hasMany('App\Store');
  }

  public function profile()
  {
  	return $this->hasMany('App\Profile');
  }
}
