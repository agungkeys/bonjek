<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\StoreCategories;
use RealRashid\SweetAlert\Facades\Alert;

class MasterStoreCategoriesController extends Controller
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

    $categories = StoreCategories::orderBy('id', 'desc')->paginate(10);
    return view('pages/admin/master/store_categories', compact('categories'));
  }

  public function store(Request $request){
    StoreCategories::create([
      'name' => $request->name,
    ]);
    return redirect()->back()->withSuccessMessage('Master Store Category Successfuly Added!', 'success');
  }

  public function destroy($id){
    StoreCategories::destroy($id);
    return redirect()->back()->withErrorMessage('Master Store Category Successfuly Remove!');
  }
}
