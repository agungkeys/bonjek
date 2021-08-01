<?php

namespace App\Http\Controllers\Store;

use App\Orders;
use App\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
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
  //
  public function index()
  {
    return view('pages/store/checkout');
  }

  public function show($slug)
  {
    $orders = Orders::where('invoice_id', 'like', '%'.$slug.'%')->get();
    $order_items = OrderItems::where('invoice_id', 'like', '%'.$slug.'%')->get();

    // dd($orders, $order_items);
    return view('pages/store/checkout', compact('orders', 'order_items'));
    // return view('pages/store/show', compact('store', 'products', 'data_product_sub_categories'));
  }
}
