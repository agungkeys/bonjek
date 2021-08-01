<?php

use App\ProductSubCategories;
use App\DistrictShippingCharge;
use App\Orders;
use App\OrderItems;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::domain('toko.'.env('SESSION_DOMAIN'))->group(function() {
// 	Route::get('/', 'Store\StoreController@index')->name('stores');
// 	Route::get('/{slug}', 'Store\StoreController@show')->name('store.name');
// });

Route::get('/', 'IndexController@index')->name('index');

Route::get('/sitemap', function() {
	// SitemapGenerator::create('http://dev-ruangkita.id/')->writeToFile('sitemap.xml');
	$sitemap = Sitemap::create()
		->add(Url::create('/about'))
		->add(Url::create('/login'));

	Store::all()->each(function (Store $storeItem) use ($sitemap) {
    $sitemap->add(Url::create("/stores/{$storeItem->slug}"));
	});

	$sitemap->writeToFile(public_path('sitemap.xml'));
	return 'sitemap created';
});

Route::get('/about', 'AboutController@index')->name('about');

Route::get('/events', 'EventsController@index')->name('events');

Route::get('/umkm', 'Store\StoreController@index')->name('stores');
Route::get('/umkm/{slug}', 'Store\StoreController@show')->name('store.name');
Route::get('/keranjang', 'Store\CartController@index')->name('cart');
Route::get('/checkout/{slug}', 'Store\CheckoutController@show')->name('checkout');


Auth::routes();

Route::group(['prefix' => 'admin'], function () {
	Route::get('/', 'Admin\DashboardController@index')->name('admin')->middleware('is_admin');
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard')->middleware('is_admin');

	// Master Categories
	Route::get('/master/categories', 'Admin\MasterCategoriesController@index')->name('admin.master.categories')->middleware('is_admin');
	Route::post('/master/categories/store', 'Admin\MasterCategoriesController@store')->name('admin.master.categories.store')->middleware('is_admin');
	Route::get('/master/categories/destroy/{id}', 'Admin\MasterCategoriesController@destroy')->middleware('is_admin');

	// Master Tags
	Route::get('/master/tags', 'Admin\MasterTagsController@index')->name('admin.master.tags')->middleware('is_admin');
	Route::post('/master/tags/store', 'Admin\MasterTagsController@store')->name('admin.master.tags.store')->middleware('is_admin');
	Route::get('/master/tags/destroy/{id}', 'Admin\MasterTagsController@destroy')->middleware('is_admin');

	// Master Users
	Route::get('/master/users', 'Admin\MasterUsersController@index')->name('admin.master.users')->middleware('is_admin');
	Route::post('/master/users/store', 'Admin\MasterUsersController@store')->name('admin.master.users.store')->middleware('is_admin');
	Route::get('/master/users/destroy/{id}', 'Admin\MasterUsersController@destroy')->middleware('is_admin');

	// Master Store Categories
	Route::get('/master/store-categories', 'Admin\MasterStoreCategoriesController@index')->name('admin.master.store.categories')->middleware('is_admin');
	Route::post('/master/store-categories/store', 'Admin\MasterStoreCategoriesController@store')->name('admin.master.store.categories.store')->middleware('is_admin');
	Route::get('/master/store-categories/destroy/{id}', 'Admin\MasterStoreCategoriesController@destroy')->middleware('is_admin');

	// Master Product Categories
	Route::get('/master/product-categories', 'Admin\MasterProductCategoriesController@index')->name('admin.master.product.categories')->middleware('is_admin');
	Route::post('/master/product-categories/store', 'Admin\MasterProductCategoriesController@store')->name('admin.master.product.categories.store')->middleware('is_admin');
	Route::get('/master/product-categories/destroy/{id}', 'Admin\MasterProductCategoriesController@destroy')->middleware('is_admin');

	// Master Product Sub categories
	Route::get('/master/product-sub-categories', 'Admin\MasterProductSubCategoriesController@index')->name('admin.master.product.sub.categories')->middleware('is_admin');
	Route::post('/master/product-sub-categories/store', 'Admin\MasterProductSubCategoriesController@store')->name('admin.master.product.categories.store')->middleware('is_admin');
	Route::get('/master/product-sub-categories/destroy/{id}', 'Admin\MasterProductSubCategoriesController@destroy')->middleware('is_admin');

	// Master City
	Route::get('/master/city', 'Admin\MasterCityController@index')->name('admin.master.city')->middleware('is_admin');
	Route::post('/master/city/store', 'Admin\MasterCityController@store')->name('admin.master.city.store')->middleware('is_admin');
	Route::get('/master/city/destroy/{id}', 'Admin\MasterCityController@destroy')->middleware('is_admin');

	// Master District
	Route::get('/master/district', 'Admin\MasterDistrictController@index')->name('admin.master.district')->middleware('is_admin');
	Route::post('/master/district/store', 'Admin\MasterDistrictController@store')->name('admin.master.district.store')->middleware('is_admin');
	Route::get('/master/district/destroy/{id}', 'Admin\MasterDistrictController@destroy')->middleware('is_admin');

	// Master Location Shipping Charge
	Route::get('/master/location-charge', 'Admin\MasterLocationChargeController@index')->name('admin.master.location-charge')->middleware('is_admin');
	Route::post('/master/location-charge/store', 'Admin\MasterLocationChargeController@store')->name('admin.master.location-charge.store')->middleware('is_admin');
	Route::get('/master/location-charge/destroy/{id}', 'Admin\MasterLocationChargeController@destroy')->middleware('is_admin');

	// Banners
	Route::get('/banners', 'Admin\BannersController@index')->name('admin.banners')->middleware('is_admin');
	Route::get('/banners/create', 'Admin\BannersController@create')->name('admin.banners.create')->middleware('is_admin');
	Route::post('/banners/store', 'Admin\BannersController@store')->name('admin.banners.store')->middleware('is_admin');
	Route::get('/banners/destroy/{id}', 'Admin\BannersController@destroy')->middleware('is_admin');
	Route::get('/banners/on/{id}', 'Admin\BannersController@live')->middleware('is_admin');
	Route::get('/banners/off/{id}', 'Admin\BannersController@draft')->middleware('is_admin');

	// Store
	Route::get('/stores', 'Admin\StoresController@index')->name('admin.stores')->middleware('is_admin');
	Route::get('/stores/create', 'Admin\StoresController@create')->name('admin.stores.create')->middleware('is_admin');
	Route::post('/stores/store', 'Admin\StoresController@store')->name('admin.stores.store')->middleware('is_admin');
	Route::get('/stores/on/{id}', 'Admin\StoresController@live')->middleware('is_admin');
	Route::get('/stores/off/{id}', 'Admin\StoresController@draft')->middleware('is_admin');

	// Feature
	// Route::get('/banners', 'Admin\BannersController@index')->name('admin.banners')->middleware('is_admin');
	// Route::get('/articles', 'Admin\BannersController@index')->name('admin.articles')->middleware('is_admin');
	// Route::get('/events', 'Admin\EventsController@index')->name('admin.events')->middleware('is_admin');

	// Route::get('/master/user', 'Admin\MasterUserController@index')->name('admin.master.user')->middleware('is_admin');
	Route::get('/master/user', ['uses'=>'Admin\MasterUsersController@index', 'as'=>'master_users.index']);
	// Route::get('/master/user', 'Admin\MasterUserController@index')->name('admin.master.user')->middleware('is_admin');
});

// Route::get('/admin/dashboard', 'Administrator\DashboardController@index')->name('admin.dashboard')->middleware('is_admin');

// Route::get('/profile', 'ProfileController@index')->name('home');

Route::resource('profile', 'Member\ProfileController');
Route::resource('profile-detail', 'Member\ProfileDetailController');
Route::resource('profile-password', 'Member\ProfilePasswordController');

Route::resource('merchant', 'Member\MerchantController');
Route::resource('merchant-product', 'Member\ProductController');

// API Ajax
Route::post('/subcat', function (Request $request)
{
  $parent_id = $request->cat_id;
  $subcategories = ProductSubCategories::where('product_category_id',$parent_id)->get();
  return response()->json([
      'subcategories' => $subcategories
  ]);
})->name('subcat');

Route::post('/shippingcharge', function (Request $request)
{
  $origin_id = $request->ori_id;
	$destination_id = $request->des_id;
  $data = DistrictShippingCharge::where([
		['origin_id', '=', $origin_id],
		['destination_id', '=', $destination_id],
		])->get();
  return response()->json([
      'data' => $data
  ]);
})->name('shippingcharge');

Route::post('/submit-order', function (Request $request)
{
	$orders = Orders::create([
		'invoice_id' => request('f_invoice'),
		'customer_id' => request('f_customer_id'),
		'district_shipping_charges_id' => request('f_district_shipping_id'),
		'shipping_charge' => request('f_shipping_charge'),
		'admin_fee' => request('f_admin_fee'),
		'total_price' => request('f_total_price'),
		'status' => request('f_status'),
	]);
	return response()->json([
      'message' => 'success',
			'orders' => $orders
  ]);
})->name('submit.order');

Route::post('/submit-order-item', function (Request $request)
{
	foreach ($request->items as $item) {
    OrderItems::create([
      'order_id'   => request('f_order_id'),
			'invoice_id'   => request('f_invoice_id'),
      'product_id' => $item['item_id'],
      'quantity'   => $item['qty'],
			'price'   => $item['item_price'],
			'weight'   => $item['item_weight'],
			'weight_type'   => $item['item_weight_variant'],
			'status'   => '0',
    ]);
  }
	return response()->json([
      'message' => 'success'
  ]);
})->name('submit.order.item');



Route::get('auth/social', 'Auth\LoginController@showLoginForm')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/generate-storage-link', function () {
    Artisan::call('storage:link');
});
