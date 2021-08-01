<?php

namespace App\Http\Controllers;
use App\Banner;
use App\Store;
use App\Product;
use App\ProductSubCategories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
      $banners = Banner::where('isPublished', 1)->orderBy('id', 'DESC')->get();
      $stores_this_month = Store::whereYear('created_at', '=', '2021')->whereMonth('created_at', '=', '06')->get();
      $stores_popular = Store::where([
        ['status','=', 1],
        ['popular','!=', 0],
        ])->orderBy('id', 'DESC')->get();
      $stores = Store::where('status', 1)->orderBy('id', 'DESC')->get();
      return view('index', compact('banners', 'stores', 'stores_popular'));
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
