<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  //
  protected $fillable = ['name'];

  public function stores()
  {
  	return $this->hasMany('App\Store');
  }

  public function profile()
  {
  	return $this->hasMany('App\Profile');
  }
}
