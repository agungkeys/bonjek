<?php
namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
   * Show the application profile.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if(session('success_message')){
        Alert::success('Success!', session('success_message'));
    }
    if(session('error_message')){
        Alert::error('Failed!', session('error_message'));
    }

    return view('pages/member/index');
  }
  

  public function edit($id)
  {
    $url = request()->fullUrl();
    $url = explode('?', $url);
    if(!empty($url[1])){
      $url = $url[1];
      return view('pages/member/edit', compact('url'));
    }
    return view('pages/member/edit');
  }

  public function update(Request $request, $id)
  {
    $this->validate(request(), [
      'name' => ['required'],
      'telp' => ['required', 'min:10']
    ]);

    $user = auth()->user();
    $user->name = request('name');
    $user->telp = request('telp');

    $user->save();

    if(request('url') !== null){
      return redirect('/cart')->withSuccessMessage('Data profil berhasil diubah!');
    }else{
      return redirect('/profile')->withSuccessMessage('Data profil berhasil diubah!');
    }
  }

  public function show($id)
  {
    return view('pages/member/index');
  }
}
