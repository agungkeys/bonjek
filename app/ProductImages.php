<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Image;

class ProductImages extends Model
{
  //
  public $fillable = ['url', 'product_id'];

  public const SMALL = '135x141';
	public const MEDIUM = '312x400';
	public const LARGE = '600x656';
	public const EXTRA_LARGE = '1125x1200';

  public function product() {
  	return $this->belongsTo('App\Product');
  }

  public static function upload_product_images($product_id, $existings = null) {
    if(!request()->hasFile('images')) {
      return false;
    }

    foreach (request()->file('images') as $key => $image) {
      Storage::disk('public')->put('images/', $image);
      // Save image thumbnail if new data
      $destinationPathThumb = public_path('/storage/images/thumbnail/'.$image->hashName());
      $img = Image::make($image->path());
      $img->resize(300, 300, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPathThumb);

      self::save_image($product_id, $key, $image);
    }
  }

  public static function save_image($product_id, $key, $image) {
  	$img = ProductImages::where(['product_id' => $product_id])->skip($key)->take(1)->first();

  	if($img) {
  		$filename = str_replace('/storage/', '', $img->url);
  		Storage::disk('public')->delete($filename);

      // Save naming file image
  		$img->url = '/storage/images/thumbnail/'.$image->hashName();
  		$img->save();

      // Thumbnail Test
      // $img->url = '/storage/images/thumbnail/'.$image->hashName();

      // $destinationPath = public_path('/thumbnail');
      // $img = Image::make($image->path());

      // $img->resize(100, 100, function ($constraint) {
      //     $constraint->aspectRatio();
      // })->save();

      $destinationPathThumb = public_path('/storage/images/thumbnail/'.$image->hashName());
      $img = Image::make($image->path());
      $img->resize(400, 400, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
      })->save($destinationPathThumb);

      $destinationPath = public_path('/storage/images');
      $image->move($destinationPath, $image->hashName());
  	}else{
      ProductImages::create([
        'url' => '/storage/images/thumbnail/'.$image->hashName(),
        'product_id' => $product_id,
      ]);
  	}
  }
}
