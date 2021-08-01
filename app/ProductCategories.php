<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
  //
  protected $fillable = ['name', 'slug'];

  public function product()
  {
    return $this->hasOne(Product::class);
  }

  public function productSubCategories()
  {
    return $this->hasMany(ProductSubCategories::class);
  }
}
