<?php

namespace App\Http\Controllers\member;

use App\Profile;
use App\City;
use App\District;
use App\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileDetailController extends Controller
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
        Alert::error('Failed!', session('error_message'));
    }

    $profile = Profile::where('user_id', auth()->id())->first();
    
    if(!$profile){
      return redirect(route('profile-detail.create'));
    }else{
      return redirect(route('profile-detail.edit', auth()->id()));
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
    $store_districts  = District::all();
    $store_cities     = City::all();
    $profile = Profile::where('user_id', auth()->id())->first();
    if(!$profile){
      $url = request()->fullUrl();
      $url = explode('?', $url);
      if(!empty($url[1])){
        $url = $url[1];
        return view('pages/member/detail/create', compact('store_districts', 'store_cities', 'url'));
      }
      return view('pages/member/detail/create', compact('store_districts', 'store_cities'));
    }else{
      return redirect(route('profile-detail.edit', auth()->id()));
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
    //
    $this->validate(request(), [
      'city_id' => ['required'],
      'district_id' => ['required' ,'min:0', 'not_in:0'],
      'address' => ['required', 'string']
    ]);

    $store = Profile::create([
      'bio'         => request('bio'),
      'address'     => request('address'),
      'user_id'     => auth()->id(),
      'district_id' => request('district_id'),
      'city_id'     => request('city_id'),
      'address'     => request('address'),
    ]);

    if(request()->hasFile('image')) {
      $image = request()->file('image');
      Storage::disk('public')->put('images/', $image);
      $store->img = '/storage/images/'.$image->hashName();
      $store->save();
    }

    if(request('url')){
      return redirect('/cart')->withSuccessMessage('Detail profil berhasil disimpan!');
    }else{
      return redirect('/profile')->withSuccessMessage('Detail profil berhasil disimpan!');
    }
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

    $profile = Profile::where('user_id', auth()->id())->first();
    $districts   = District::all();
    $cities       = City::all();

    
    if($profile && $profile->user_id == $id){
        
      $url = request()->fullUrl();
      $url = explode('?', $url);
      if(!empty($url[1])){
        $url = $url[1];
        return view('pages/member/detail/edit', compact('profile', 'districts', 'cities', 'url'));
        // return view('pages/member/edit', ['url' => $url]);
      }
      return view('pages/member/detail/edit', compact('profile', 'districts', 'cities'));

    }else{
      return redirect(route('profile.index'));
    }

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    $this->validate(request(), [
      'city_id' => ['required'],
      'district_id' => ['required' ,'min:0', 'not_in:0'],
      'address' => ['required', 'string']
    ]);

    $profile = Profile::where('user_id', $id)->first();
    $profile->bio = request('bio');
    $profile->address = request('address');
    $profile->district_id = request('district_id');
    $profile->city_id = request('city_id');
    $profile->address = request('address');

    if(request()->hasFile('image')) {
      $image = request()->file('image');
      Storage::disk('public')->put('images/', $image);
      $profile->img = '/storage/images/'.$image->hashName();
    }

    $profile->save();

    if(request('url')){
      return redirect('/cart')->withSuccessMessage('Data profil berhasil diubah!');
    }else{
      return redirect('/profile')->withSuccessMessage('Data profil berhasil diubah!');
    }
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
  }
}
