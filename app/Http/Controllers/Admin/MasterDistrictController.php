<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\City;
use App\District;
use RealRashid\SweetAlert\Facades\Alert;

class MasterDistrictController extends Controller
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

    $city = City::all();
    $district = District::orderBy('id', 'desc')->paginate(10);
    return view('pages/admin/master/district', compact('city', 'district'));
  }

  public function store(Request $request){
    if($request->city === null || $request->name === null){
      return redirect()->back()->withWarningMessage('Please Fill All Data...!');
    }else{
      District::create([
        'city_id' => $request->city,
        'name' => $request->name,
      ]);
      return redirect()->back()->withSuccessMessage('Master District Successfuly Added!', 'success');
    }
  }

  public function destroy($id){
    District::destroy($id);
    return redirect()->back()->withErrorMessage('Master District Successfuly Remove!');
  }
}
