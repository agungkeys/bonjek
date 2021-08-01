<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\ProductCategories;
use App\ProductSubCategories;
use RealRashid\SweetAlert\Facades\Alert;

class MasterProductSubCategoriesController extends Controller
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
    if(session('warning_message')){
      Alert::warning('Warning!', session('warning_message'));
    }

    $categories = ProductCategories::all();
    $sub_categories = ProductSubCategories::orderBy('id', 'desc')->paginate(10);
    return view('pages/admin/master/product_sub_categories', compact('categories', 'sub_categories'));
  }

  public function store(Request $request){
    if($request->category === null || $request->name === null){
      return redirect()->back()->withWarningMessage('Please Fill All Data...!');
    }else{
      ProductSubCategories::create([
        'product_category_id' => $request->category,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
      ]);
      return redirect()->back()->withSuccessMessage('Master Product Sub Category Successfuly Added!', 'success');
    }
  }

  public function destroy($id){
    ProductSubCategories::destroy($id);
    return redirect()->back()->withErrorMessage('Master Product Sub Category Successfuly Remove!');
  }
}
