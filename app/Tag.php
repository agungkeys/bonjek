<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = ['tag_name', 'slug'];

  public function articles()
  {
    return $this->belongsToMany('App\Articles', 'tag_post', 'tag_id', 'post_id');
  }
}
