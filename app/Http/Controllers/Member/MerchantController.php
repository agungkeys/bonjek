<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

use App\StoreCategories;
use App\City;
use App\District;
use App\Store;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MerchantController extends Controller
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
    // $categories = StoreCategories::all();
    $store = Store::where('user_id', auth()->id())->first();

    if($store){
       $products = Product::where('store_id', $store->id)->orderBy('id', 'DESC')->get();
        return view('pages/merchant/index', compact('store', 'products'));
    }else{
        return view('pages/merchant/index', compact('store'));
    }

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // $id_user = Auth::user()->id;
    $store = Store::where('user_id', auth()->id())->first();
    $telp = Auth::user()->telp;

    $store_categories = StoreCategories::all();
    $store_districts  = District::all();
    $store_cities     = City::all();

    if(!$telp){
      return redirect(route('profile.edit', auth()->id()));
    }else{
      if(!$store){
        return view('pages/merchant/create', compact('store_categories', 'store_districts', 'store_cities'));
      }else{
        return view('pages/merchant/index', compact('store'));
      }
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $this->validate(request(), [
      'name' => ['required', 'string', 'min:5'],
      'store_category_id' => ['required'],
      'city_id' => ['required'],
      'district_id' => ['required'],
      'address' => ['required', 'string'],
      'telp' => ['required', 'numeric', 'min:10']
    ]);

    $store = Store::create([
      'name'        => request('name'),
      'slug'        => Str::slug(request('name')).'-'.now()->format('dmyhis'),
      'description' => request('description'),
      'user_id'     => auth()->id(),
      'store_category_id' => request('store_category_id'),
      'district_id' => request('district_id'),
      'city_id'     => request('city_id'),
      'address'     => request('address'),
      'store_open'     => request('store_open'),
      'store_close'     => request('store_close'),
      'telp'        => request('telp'),
      'status'      => '0',
    ]);

    if(request()->hasFile('image')) {
      $image = request()->file('image');
      Storage::disk('public')->put('images/', $image);
      $store->logo = '/storage/images/'.$image->hashName();
      $store->save();
    }

    return redirect('/merchant')->withSuccessMessage('Toko berhasil dibuat!');
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
    $store = Store::find($id);

    if($store && $store->user_id == auth()->id()){
      return view('pages.merchant.index', compact('store'));
    }else{
      return view('pages.member.profile');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $store = Store::find($id);

    $store_categories = StoreCategories::all();
    $store_districts   = District::all();
    $store_cities       = City::all();
    if($store && $store->user_id == auth()->id()){
      return view('pages.merchant.edit', compact('store', 'store_categories', 'store_districts', 'store_cities'));
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
  public function update(Request $request, $store)
  {
    $this->validate(request(), [
      'name' => ['required', 'string', 'min:5'],
      'store_category_id' => ['required'],
      'city_id' => ['required'],
      'district_id' => ['required'],
      'address' => ['required', 'string'],
      'telp' => ['required', 'numeric', 'min:10']
    ]);

    $store = Store::find($store);
    $store->name = request('name');
    $store->slug        = Str::slug(request('name')).'-'.now()->format('dmyhis');
    $store->description = request('description');
    $store->store_category_id = request('store_category_id');
    $store->district_id = request('district_id');
    $store->city_id     = request('city_id');
    $store->address     = request('address');
    $store->store_open     = request('store_open');
    $store->store_close     = request('store_close');
    $store->telp        = request('telp');
    $store->status      = '0';

    if(request()->hasFile('image')) {
      $image = request()->file('image');
      Storage::disk('public')->put('images/', $image);
      $store->logo = '/storage/images/'.$image->hashName();
    }

    $store->save();

    return redirect('/merchant')->withSuccessMessage('Toko berhasil diubah!');

    // dd($store->name);

    // $this->validate(request(), [
    //   'name'        => 'required',
    //   'user_id'     => 'unique:shops'
    // ]);
    //
    // $shop->name = request('name');
    // $shop->description = request('description');
    //
    // if(request()->hasFile('image')) {
    //   $image = request()->file('image');
    //   Storage::disk('public')->put('images/', $image);
    //   $shop->logo = '/storage/images/'.$image->hashName();
    // }
    //
    // $shop->save();
  }

  public function product()
  {
    $store = Store::where('user_id', auth()->id())->first();
    dd($store);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($store)
  {
    //
  }
}
