<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\ProductCategories;
use RealRashid\SweetAlert\Facades\Alert;

class MasterProductCategoriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index()
  {
    if(session('success_message')){
      Alert::success('Success!', session('success_message'));
    }
    if(session('error_message')){
      Alert::error('Removed!', session('error_message'));
    }

    $categories = ProductCategories::orderBy('id', 'desc')->paginate(10);
    return view('pages/admin/master/product_categories', compact('categories'));
  }

  public function store(Request $request){
    ProductCategories::create([
      'name' => $request->name,
      'slug' => Str::slug($request->name),
    ]);
    return redirect()->back()->withSuccessMessage('Master Product Category Successfuly Added!', 'success');
  }

  public function destroy($id){
    ProductCategories::destroy($id);
    return redirect()->back()->withErrorMessage('Master Product Category Successfuly Remove!');
  }
}
