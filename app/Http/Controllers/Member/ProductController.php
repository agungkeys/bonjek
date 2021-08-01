<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;

use App\ProductCategories;
use App\ProductSubCategories;
use App\Product;
use App\ProductImages;
use App\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      if(session('success_message')){
          Alert::success('Success!', session('success_message'));
      }
      if(session('error_message')){
          Alert::error('Removed!', session('error_message'));
      }

      $store = Store::where('user_id', auth()->id())->first();
      if(!$store){
        return view('pages/merchant/');
      }else{
        return redirect('/merchant-product/create');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
      $store = Store::where('user_id', auth()->id())->first();
      $product_categories = ProductCategories::all();
      $product_sub_categories = ProductSubCategories::all();

      return view('pages/merchant/product/create', compact('product_categories', 'product_sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
      $this->validate(request(), [
        'product_category_id' => ['required'],
        'product_sub_category_id' => ['required'],
        'name' => ['required', 'string', 'min:5'],
        'price' => ['required'],
        'weight' => ['required'],
      ]);

      $product = Product::create([
        'product_category_id'     => request('product_category_id'),
        'product_sub_category_id' => request('product_sub_category_id'),
        'name'        => request('name'),
        'description' => request('description'),
        'user_id'     => auth()->id(),
        'price'       => str_replace( '.', '', request('price')),
        'discount'       => str_replace( '%', '', request('discount') ? request('discount') : '0'),
        'stock' => request('stock'),
        'weight_variant' => request('weight_variant'),
        'weight' => request('weight'),
        'slug'        => Str::slug(request('name')).'-'.now()->format('dmyhis'),
        'status'      => '1',
        'store_id'     => auth()->user()->store->id,
      ]);

      ProductImages::upload_product_images($product->id);
      return redirect('/merchant')->withSuccessMessage('Product berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
      $product= Product::find($id);
      $product_categories = ProductCategories::all();
      $product_sub_categories = ProductSubCategories::all();

      if($product && $product->user_id == auth()->id()){
        return view('pages.merchant.product.edit', compact('product', 'product_categories', 'product_sub_categories'));
      }else{
        return view('pages.member.profile');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      //
      $this->validate(request(), [
        'product_category_id' => ['required'],
        'product_sub_category_id' => ['required'],
        'name' => ['required', 'string', 'min:5'],
        'price' => ['required'],
        'weight' => ['required'],
      ]);

      $product = Product::where('slug', $slug)->first();


      $product->product_category_id     = request('product_category_id');
      $product->product_sub_category_id = request('product_sub_category_id');
      $product->name        = request('name');
      $product->description = request('description');
      $product->price       = str_replace( '.', '', request('price'));
      $product->discount    = str_replace( '%', '', request('discount')) ? str_replace( '%', '', request('discount')) : '0';
      $product->stock       = request('stock');
      $product->weight_variant = request('weight_variant');
      $product->weight      = request('weight');
      $product->slug        = Str::slug(request('name')).'-'.now()->format('dmyhis');

      $product->save();

      ProductImages::upload_product_images($product->id, request('existings'));
      return redirect('/merchant')->withSuccessMessage('Data produk berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);

        if($product->user_id == auth()->id()) {
            $product->delete();
        }
        return redirect('/merchant')->withSuccessMessage('Data produk berhasil dihapus!');
    }
}
