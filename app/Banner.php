<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $fillable = [
    'user_id',
    'title',
    'isPublished',
    'link',
    'type',
    'category_id',
    'original',
    'extra_large',
    'small'
  ];

  protected $guarded = ['user_id', 'image'];

  public const UPLOAD_DIR = 'images';

	public const ACTIVE = 'active';
	public const INACTIVE = 'inactive';

	public const STATUSES = [
		self::ACTIVE => 'Active',
		self::INACTIVE => 'Inactive',
	];

	public const EXTRA_LARGE = '1000x1000';
	public const SMALL = '300x300';

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function user(){
    return $this->belongsTo('App\User')->withDefault();
  }
}
