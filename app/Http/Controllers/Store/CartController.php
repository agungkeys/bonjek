<?php

namespace App\Http\Controllers\Store;

use App\Store;
use App\Product;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
  public function index()
  {
    // $telp = Auth::user()->telp;
    // $profile = Auth::user()->profile;
    $district = District::all();

    return view('pages/store/cart', compact('district'));
    // if(!$telp){
    //   return redirect('/profile/'.Auth::user()->id.'/edit?isFromCart=true');
    // }else{
    //   if(!$profile){
    //     return redirect('/profile-detail/create?isFromCart=true');
    //   }else{
    //     return view('pages/store/cart', compact('district'));
    //   }
    // }
  }
}
