<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\City;
use App\District;
use App\DistrictShippingCharge;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use DataTables;

class MasterLocationChargeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index(Request $request)
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
    $district = District::all();

    if ($request->ajax()) {
      $charge = DB::table('district_shipping_charges')
        ->join('cities', 'district_shipping_charges.city_id', '=', 'cities.id')
        ->join('districts AS origins', 'district_shipping_charges.origin_id', '=', 'origins.id')
        ->select([
          'district_shipping_charges.id',
          'cities.name AS city',
          'origins.name AS origin',
          'detinations.name AS destination',
          'district_shipping_charges.price',
        ])
        ->get();
      return Datatables::of($charge)->make(true);
    }

    // $location_charges = DistrictShippingCharge::orderBy('id', 'desc')->paginate(10);
    // dd(DB::table('cities')->get());

    return view('pages/admin/master/location_charge', compact('city', 'district'));
  }

  public function store(Request $request){
    if($request->city === null || $request->origin === null || $request->destination === null || $request->price === null){
      return redirect()->back()->withWarningMessage('Please Fill Data: City, Origin, Destination, Price. !');
    }else{
      $data = DistrictShippingCharge::where([
    		['origin_id', '=', $request->origin],
    		['destination_id', '=', $request->destination],
  		])->first();

      if($data === null){
        DistrictShippingCharge::create([
          'city_id' => $request->city,
          'origin_id' => $request->origin,
          'destination_id' => $request->destination,
          'price' => $request->price,
        ]);
        return redirect()->back()->withSuccessMessage('Master Location Charge Successfuly Added!', 'success');
      }else{
        return redirect()->back()->withWarningMessage('Data already mapping...!');
      }
    }
  }

  public function destroy($id){
    DistrictShippingCharge::destroy($id);
    return redirect()->back()->withErrorMessage('Master Location Charge Successfuly Remove!');
  }
}
