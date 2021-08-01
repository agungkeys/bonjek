<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilePasswordController extends Controller
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
    if(session('success_message')){
        Alert::success('Success!', session('success_message'));
    }
    if(session('error_message')){
        Alert::error('Failed!', session('error_message'));
    }

    return view('pages/member/password/index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

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
    $this->validate(request(), [
      'old_password' => ['required'],
      'new_password' => ['required', 'min:8'],
      'renew_password' => ['same:new_password', 'min:8'],
    ]);

    $user = auth()->user();

    if (Hash::check(request()->old_password, $user->password)) {
      $user->fill(['password' => Hash::make(request()->new_password)])->save();
      // request()->session()->withSuccessMessage('Password berhasil diubah!, silahkan login kembali');
      return redirect('/profile')->withSuccessMessage('Password berhasil diubah!, silahkan Keluar aplikasi dan login kembali');
    } else {
      return redirect('/profile-password')->withErrorMessage('Password gagal diubah!, coba ubah kembali');
    }
    //
    // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    // return redirect('/logout')->withSuccessMessage('Password berhasil diubah!, silahkan login kembali');
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
