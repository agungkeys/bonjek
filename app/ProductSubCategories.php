<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategories extends Model
{
  //
  protected $fillable = ['product_category_id', 'name', 'slug'];

  public function productCategory()
  {
    return $this->hasOne(ProductCategories::class);
  }
}
