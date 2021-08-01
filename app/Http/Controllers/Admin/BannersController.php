<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Banner;
use Image;

class BannersController extends Controller
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
    if(session('warning_message')){
      Alert::error('Error!', session('warning_message'));
    }

    $banners = Banner::paginate(10);
    return view('pages/admin/banner/index', compact('banners'));
  }

  public function create()
  {
    return view('pages/admin/banner/create');
  }

  public function store(Request $request)
  {
    $imgValid = $request->file('image')->getSize();
    if($imgValid) {
      $this->validate(request(), [
        'title' => ['required', 'string'],
        'link' => ['required', 'string'],
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);

      $params = $request->except('_token');
  		$image = $request->file('image');
  		$name = Str::slug($params['title']) . '_' . time();
  		$fileName = $name . '.' . $image->getClientOriginalExtension();

  		$folder = Banner::UPLOAD_DIR. '/banners';

  		$filePath = $image->storeAs($folder . '/original', $fileName, 'public');

  		$resizedImage = $this->_resizeImage($image, $fileName, $folder);

  		$params['original'] = $filePath;
  		$params['extra_large'] = $resizedImage['extra_large'];
  		$params['small'] = $resizedImage['small'];
  		$params['user_id'] = Auth::user()->id;
      $params['category_id'] = '1';
      $params['type'] = 'landing';
      $params['link'] = $request->link;
      $params['isPublished'] = '1';

  		$banner_save = Banner::create($params);

  		if ($banner_save) {
        return redirect('/admin/banners')->withSuccessMessage('Banner successfully created!');
  		} else {
        return redirect('/admin/banners')->withWarningMessage('Banner could not be created.');
  		}
    }else{
      return redirect('admin/banners')->withWarningMessage('Image to big or Image type not support.');
    }
  }

  public function destroy($id)
  {
    Banner::destroy($id);
    return redirect()->back()->withErrorMessage('Banner Successfuly Remove!');
  }

  public function live($id)
  {
    $banner = Banner::find($id);
    $banner->isPublished = '1';
    $banner->save();

    return redirect('/admin/banners')->withSuccessMessage('Banner '.$id.' successfully update!');
  }

  public function draft($id)
  {
      $banner = Banner::find($id);
      $banner->isPublished = '0';
      $banner->save();

      return redirect('/admin/banners')->withSuccessMessage('Banner '.$id.' successfully update!');
  }

  private function _resizeImage($image, $fileName, $folder)
	{
		$resizedImage = [];

		$smallImageFilePath = $folder . '/small/' . $fileName;
		$size = explode('x', Banner::SMALL);
		list($width, $height) = $size;

		$smallImageFile = Image::make($image)->resize($width, $height, function($constraint) {
      $constraint->aspectRatio();
    })->stream();
		if (Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
			$resizedImage['small'] = $smallImageFilePath;
		}

		$extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
		$size = explode('x', Banner::EXTRA_LARGE);
		list($width, $height) = $size;

		$extraLargeImageFile = Image::make($image)->resize($width, $height, function($constraint) {
      $constraint->aspectRatio();
    })->stream();
		if (Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
			$resizedImage['extra_large'] = $extraLargeImageFilePath;
		}

		return $resizedImage;
	}
}
