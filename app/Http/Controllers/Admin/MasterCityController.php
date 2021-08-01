<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\City;

use RealRashid\SweetAlert\Facades\Alert;

class MasterCityController extends Controller
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

        $cities = City::orderBy('id', 'desc')->paginate(10);
        return view('pages/admin/master/city', compact('cities'));
    }

    public function store(Request $request){
        City::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->withSuccessMessage('City Successfuly Added!', 'success');
    }

    public function destroy($id){
        City::destroy($id);
        return redirect()->back()->withErrorMessage('City Successfuly Remove!');
    }
}
