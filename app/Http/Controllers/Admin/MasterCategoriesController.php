<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Category;

use RealRashid\SweetAlert\Facades\Alert;

class MasterCategoriesController extends Controller
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
     * Show the application master categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session('success_message')){
            Alert::success('Success!', session('success_message'));
        }
        if(session('error_message')){
            Alert::error('Removed!', session('error_message'));
        }

        $categories = Category::paginate(10);
        return view('pages/admin/master/categories', compact('categories'));
    }

    public function store(Request $request){
        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);
        return redirect()->back()->withSuccessMessage('Category Successfuly Added!', 'success');
    }

    public function destroy($id){
        Category::destroy($id);
        return redirect()->back()->withErrorMessage('Category Successfuly Remove!');
    }
}
