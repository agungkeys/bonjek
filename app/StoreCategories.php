<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategories extends Model
{
  //
  protected $fillable = ['name'];

  public function store()
  {
    return $this->hasOne(Store::class); 
  }
}
