<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Tag;
use RealRashid\SweetAlert\Facades\Alert;

class MasterTagsController extends Controller
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
    public function index()
    {
        if(session('success_message')){
            Alert::success('Success!', session('success_message'));
        }
        if(session('error_message')){
            Alert::error('Removed!', session('error_message'));
        }

        $tags = Tag::paginate(10);
        return view('pages/admin/master/tags', compact('tags'));
    }

    public function store(Request $request){
        Tag::create([
            'tag_name' => $request->tag_name,
            'slug' => Str::slug($request->tag_name),
        ]);
        return redirect()->back()->withSuccessMessage('Tag Successfuly Added!', 'success');
    }

    public function destroy($id){
        Tag::destroy($id);
        return redirect()->back()->withErrorMessage('Tag Successfuly Remove!');
    }
}
