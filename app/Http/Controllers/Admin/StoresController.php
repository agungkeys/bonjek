<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Store;
use App\StoreCategories;
use App\District;
use App\City;
use Image;


class StoresController extends Controller
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
  public function index(Request $request)
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

    if ($request->ajax()) {
      $stores = DB::table('stores')
        ->join('store_categories AS category', 'stores.store_category_id', '=', 'category.id')
        ->join('districts AS district', 'stores.district_id', '=', 'district.id')
        ->join('cities AS city', 'stores.city_id', '=', 'city.id')
        ->select([
          'stores.id AS id',
          'category.name AS category',
          'stores.small AS logo',
          'stores.name AS name',
          'stores.slug AS slug',
          'stores.description AS description',
          'city.name AS city',
          'district.name AS district',
          'stores.store_open AS open',
          'stores.store_close AS close',
          'stores.telp AS telp',
          'stores.popular AS popular',
          'stores.status AS status',
          DB::raw('(SELECT COUNT(*) FROM products WHERE products.store_id = stores.id) as count_products'),
        ])
        ->get();
        return Datatables::of($stores)->make(true);
    }

    return view('pages/admin/store/index');
  }

  public function create()
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

    $store_categories = StoreCategories::all();
    $store_districts  = District::all();
    $store_cities     = City::all();

    return view('pages/admin/store/create', compact('store_categories', 'store_districts', 'store_cities'));
  }

  public function store(Request $request)
  {
      $this->validate(request(), [
        'name' => ['required', 'string'],
        'description' => ['required', 'string'],
        'store_category_id' => ['required'],
        'store_category_id' => ['required'],
        'city_id' => ['required'],
        'district_id' => ['required'],
        'address' => ['required', 'string'],
        'store_open' => ['required'],
        'store_close' => ['required'],
        'telp' => ['required'],
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);

      $phone = $request->telp;
      $phone = $this->_phoneNumber($phone);

      if(!!$phone){
        $imgValid = $request->file('image')->getSize();
        if($imgValid) {
          $params = $request->except('_token');
      		$image = $request->file('image');
      		$name = Str::slug($params['name']) . '_' . time();
      		$fileName = $name . '.' . $image->getClientOriginalExtension();

      		$folder = Store::UPLOAD_DIR. '/stores';

      		$filePath = $image->storeAs($folder . '/original', $fileName, 'public');

      		$resizedImage = $this->_resizeImage($image, $fileName, $folder);

      		$params['original'] = $filePath;
      		$params['extra_large'] = $resizedImage['extra_large'];
          $params['large'] = $resizedImage['large'];
          $params['medium'] = $resizedImage['medium'];
      		$params['small'] = $resizedImage['small'];
      		$params['user_id'] = '0';
          $params['name'] = $request->name;
          $params['slug'] = $request->slug;
          $params['description'] = $request->description;
          $params['store_category_id'] = $request->store_category_id;
          $params['city_id'] = $request->city_id;
          $params['district_id'] = $request->district_id;
          $params['address'] = $request->address;
          $params['store_open'] = $request->store_open;
          $params['store_close'] = $request->store_close;
          $params['telp'] = $phone;
          $params['status'] = '0';
          $params['popular'] = '0';

          $store_save = Store::create($params);

          if ($store_save) {
            return redirect('/admin/stores')->withSuccessMessage('Store successfully created!');
      		} else {
            return redirect('/admin/stores')->withWarningMessage('Store could not be created.');
      		}
        }
      }else{
        return back()->withWarningMessage('Phone number invalid');
      }
  }

  public function destroy($id)
  {
    Store::destroy($id);
    return redirect()->back()->withErrorMessage('Store Successfuly Remove!');
  }

  public function live($id)
  {
    $banner = Store::find($id);
    $banner->status = '1';
    $banner->save();

    return redirect('/admin/stores')->withSuccessMessage('Store '.$id.' successfully update!');
  }

  public function draft($id)
  {
      $banner = Store::find($id);
      $banner->status = '0';
      $banner->save();

      return redirect('/admin/stores')->withSuccessMessage('Store '.$id.' successfully update!');
  }

  private function _resizeImage($image, $fileName, $folder)
	{
		$resizedImage = [];

		$smallImageFilePath = $folder . '/small/' . $fileName;
		$size = explode('x', Store::SMALL);
		list($width, $height) = $size;

		$smallImageFile = Image::make($image)->fit($width, $height)->stream();
		if (Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
			$resizedImage['small'] = $smallImageFilePath;
		}

		$mediumImageFilePath = $folder . '/medium/' . $fileName;
		$size = explode('x', Store::MEDIUM);
		list($width, $height) = $size;

		$mediumImageFile = Image::make($image)->fit($width, $height)->stream();
		if (Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
			$resizedImage['medium'] = $mediumImageFilePath;
		}

		$largeImageFilePath = $folder . '/large/' . $fileName;
		$size = explode('x', Store::LARGE);
		list($width, $height) = $size;

		$largeImageFile = Image::make($image)->fit($width, $height)->stream();
		if (Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
			$resizedImage['large'] = $largeImageFilePath;
		}

		$extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
		$size = explode('x', Store::EXTRA_LARGE);
		list($width, $height) = $size;

		$extraLargeImageFile = Image::make($image)->fit($width, $height)->stream();
		if (Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
			$resizedImage['extra_large'] = $extraLargeImageFilePath;
		}

		return $resizedImage;
	}

  private function _phoneNumber($phone)
  {
    // kadang ada penulisan no hp 0811 239 345
    $phone = str_replace(" ","",$phone);
    // kadang ada penulisan no hp (0274) 778787
    $phone = str_replace("(","",$phone);
    // kadang ada penulisan no hp (0274) 778787
    $phone = str_replace(")","",$phone);
    // kadang ada penulisan no hp 0811.239.345
    $phone = str_replace(".","",$phone);

    // cek apakah no hp mengandung karakter + dan 0-9
    if(!preg_match('/[^+0-9]/',trim($phone))){
        // cek apakah no hp karakter 1-4 adalah +620
        if(substr(trim($phone), 0, 4)=='+620'){
          $phoneNumber = '62'.substr(trim($phone), 4);
        }
        // cek apakah no hp karakter 1-3 adalah +62
        elseif(substr(trim($phone), 0, 3)=='+62'){
            $phoneNumber = substr(trim($phone), 1);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif(substr(trim($phone), 0, 1)=='0'){
            $phoneNumber = '62'.substr(trim($phone), 1);
        }
        // cek apakah no hp karakter 1-2 adalah 62
        elseif(substr(trim($phone), 0, 2)=='62'){
          $phoneNumber = trim($phone);
        }else{
          $phoneNumber = false;
        }
    }
    return $phoneNumber;
  }
}
