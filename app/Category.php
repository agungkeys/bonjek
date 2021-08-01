<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['category_name', 'slug'];

  public function articles()
  {
  	return $this->hasMany('App\Article');
  }

	public function banner()
  {
  	return $this->hasMany('App\Banner');
  }
}
