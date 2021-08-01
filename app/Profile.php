<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  //
  protected $fillable = ['user_id', 'img', 'address', 'district_id', 'city_id', 'bio'];

  public function user()
  {
  	return $this->belongsTo('App\User');
  }

  public function district()
  {
    return $this->belongsTo('App\District');
  }

  public function city()
  {
    return $this->belongsTo('App\City');
  }
}
