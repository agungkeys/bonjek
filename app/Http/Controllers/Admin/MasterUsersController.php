<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class MasterUsersController extends Controller
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
     * Show the application master tags.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(session('success_message')){
            Alert::success('Success!', session('success_message'));
        }
        if(session('error_message')){
            Alert::error('Removed!', session('error_message'));
        }

        // $users = User::paginate(10);
        // return view('pages/admin/master/users', compact('users'));

        if ($request->ajax()) {
          // $data = User::latest()->get();
          return Datatables::of(User::orderBy('id', 'asc')->get())
          ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d M Y'); // human readable format
          })
          ->editColumn('updated_at', function ($request) {
            return $request->updated_at->format('d M Y'); // human readable format
          })->make();
          // return Datatables::of($data)
          //   ->addIndexColumn()
          //   ->addColumn('action', function($row){
          //     $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
          //     return $btn;
          //   })
          //   ->rawColumns(['action'])
          //   ->make(true);
        }
        return view('pages/admin/master/users');
    }

    // public function store(Request $request){
    //     User::create([
    //         'tag_name' => $request->tag_name,
    //         'slug' => Str::slug($request->tag_name),
    //     ]);
    //     return redirect()->back()->withSuccessMessage('Tag Successfuly Added!', 'success');
    // }

    public function destroy($id){
        Users::destroy($id);
        return redirect()->back()->withErrorMessage('User Successfuly Remove!');
    }
}
