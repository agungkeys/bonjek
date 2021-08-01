<?php

namespace App\Http\Controllers\Store;

use App\Store;
use App\Product;
use App\ProductSubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
  //
  public function index()
  {
    return redirect('/');
  }

  public function show($slug)
  {
    $store = Store::where('slug', 'like', '%'.$slug.'%')->get();
    $store_img = Storage::path($store[0]->logo);
    $data_product_sub_categories = ProductSubCategories::all();

    if($store){
      $temp = Product::where('store_id', $store[0]['id'])->orderBy('updated_at', 'desc')->get();
      $products = $temp->groupBy('product_sub_category_id');
    }else{
      $products = [];
    }
    // dd($store_img);
    return view('pages/store/show', compact('store', 'store_img', 'products', 'data_product_sub_categories'));
  }
}
