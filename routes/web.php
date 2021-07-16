<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\BranchController;
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

Route::get('/', function () {
    return view('admin/login');
});
Route::get('login', function () {
    return view('admin/login');
})->name('login');


Route::get('/registration', function () {
    return view('admin/register');
});

//Auth::routes();

Route::post('admin/login', [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'login']);

Route::post('logout',[LoginController::class, 'logout']);



// Route::get('course','AdminController@index');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'checkAdmin']], function()
{

    //All the routes that belongs to the group goes here
   Route::get('dashboard', [AdminController::class, 'index']);
	// Route::get('dashboard', function () {
	// 	die('sadfsdf');
 //    		return view('admin/dashboard');
	// });
	
   Route::get('privacy', [AdminController::class, 'privacy']);
   Route::get('privacy-edit/{id}', [AdminController::class, 'privacy_edit']);
   Route::post('privacy-update', [AdminController::class, 'privacy_update']);

   Route::get('terms-of-use', [AdminController::class, 'termsofuse']);
   Route::get('terms-edit/{id}', [AdminController::class, 'terms_edit']);
   Route::post('terms-update', [AdminController::class, 'terms_update']);
   
	Route::get('category', [AdminController::class, 'category']);
	Route::get('category-add', [AdminController::class, 'category_add']);
	Route::post('add_categories', [AdminController::class, 'add_categories']);
	Route::get('category-edit/{id}', [AdminController::class, 'category_edit']);
	Route::get('category-delete/{id}', [AdminController::class, 'category_delete']);
	Route::get('category-block/{id}/{status}', [AdminController::class, 'category_block']);
	Route::post('category_update', [AdminController::class, 'category_update']);

	Route::get('slider', [AdminController::class, 'slider']);
	Route::get('slider-add', [AdminController::class, 'slider_add']);
	Route::post('add_slider', [AdminController::class, 'add_slider']);
	Route::get('slider-edit/{id}', [AdminController::class, 'slider_edit']);
	Route::get('slider-delete/{id}', [AdminController::class, 'slider_delete']);
	Route::get('slider-block/{id}/{status}', [AdminController::class, 'slider_block']);
	Route::post('slider_update', [AdminController::class, 'slider_update']);

	Route::get('store-management', [Dashboard::class, 'store_management']);
	Route::get('store-add', [Dashboard::class, 'store_add']);
	Route::post('add_store', [Dashboard::class, 'add_store']);
	Route::get('store-edit/{id}', [Dashboard::class, 'store_edit']);
	Route::get('store-delete/{id}', [Dashboard::class, 'store_delete']);
	Route::post('store_update', [Dashboard::class, 'store_update']);

	Route::get('role-management', [Dashboard::class, 'role_management']);
	Route::get('role-add', [Dashboard::class, 'role_add']);
	Route::post('add_role', [Dashboard::class, 'add_role']);
	Route::get('role-edit/{id}', [Dashboard::class, 'role_edit']);
	Route::get('role-delete/{id}', [Dashboard::class, 'role_delete']);
	Route::post('role_update', [Dashboard::class, 'role_update']);
	

	Route::get('sub-category', [AdminController::class, 'sub_category']);
	Route::get('sub-category-add', [AdminController::class, 'sub_category_add']);
	Route::post('add_sub_categories', [AdminController::class, 'add_sub_categories']);
	Route::get('sub-category-edit/{id}', [AdminController::class, 'sub_category_edit']);
	Route::post('sub_category_update', [AdminController::class, 'sub_category_update']);
	Route::get('sub-category-delete/{id}', [AdminController::class, 'sub_category_delete']);
	Route::get('sub-category-block/{id}/{status}', [AdminController::class, 'sub_category_block']);

	Route::get('product', [ProductController::class, 'product']);
	Route::get('product-add', [ProductController::class, 'product_add']);
	Route::post('add-product', [ProductController::class, 'add_product']);
	Route::get('product-edit/{id}', [ProductController::class, 'product_edit']);
	Route::post('product_update', [ProductController::class, 'product_update']);
	Route::get('product-delete/{id}', [ProductController::class, 'product_delete']);
	Route::post('cat_get_subcat', [ProductController::class, 'cat_get_subcat']);

	Route::get('thobe-style', [ProductController::class, 'thobe_style']);
	// Route::get('thobe-add', [ProductController::class, 'thobe_add']);
	Route::post('add-thobe', [ProductController::class, 'add_thobe']);
	Route::get('thobe-edit/{id}', [ProductController::class, 'thobe_edit']);
	Route::post('thobe_update', [ProductController::class, 'thobe_update']);
	Route::get('thobe-delete/{id}', [ProductController::class, 'thobe_delete']);

	Route::get('model-list', [ProductController::class, 'model_list']);
	Route::get('model-add', [ProductController::class, 'model_add']);
	Route::post('add-model', [ProductController::class, 'add_model']);
	Route::get('model-edit/{id}', [ProductController::class, 'model_edit']);
	Route::post('model_update', [ProductController::class, 'model_update']);
	Route::get('model-delete/{id}', [ProductController::class, 'model_delete']);

	Route::get('fabric-list', [ProductController::class, 'fabric_list']);
	Route::get('fabric-add', [ProductController::class, 'fabric_add']);
	Route::post('add-fabric', [ProductController::class, 'add_fabric']);
	Route::get('fabric-edit/{id}', [ProductController::class, 'fabric_edit']);
	Route::post('fabric_update', [ProductController::class, 'fabric_update']);
	Route::get('fabric-delete/{id}', [ProductController::class, 'fabric_delete']);

	Route::get('buttons-list', [ProductController::class, 'buttons_list']);
	Route::get('buttons-add', [ProductController::class, 'buttons_add']);
	Route::post('add-buttons', [ProductController::class, 'add_buttons']);
	Route::get('buttons-edit/{id}', [ProductController::class, 'buttons_edit']);
	Route::post('buttons_update', [ProductController::class, 'buttons_update']);
	Route::get('buttons-delete/{id}', [ProductController::class, 'buttons_delete']);
	

	Route::get('students-list', [AdminController::class, 'students_list']);
	Route::get('students-edit/{id}', [AdminController::class, 'students_edit']);
	Route::get('students-delete/{id}', [AdminController::class, 'students_delete']);
	Route::get('students-block/{id}/{status}', [AdminController::class, 'students_block']);
	Route::post('student_update', [AdminController::class, 'student_update']);
	
	Route::get('subadmin-list', [AdminController::class, 'subadmin_list']);
	Route::get('subadmin-add', [AdminController::class, 'subadmin_add']);
	Route::post('add-admin', [AdminController::class, 'add_admin']);
	Route::get('subadmin-block/{id}/{status}', [AdminController::class, 'subadmin_block']);
	Route::get('subadmin-delete/{id}', [AdminController::class, 'subadmin_delete']);
	Route::get('subadmin-edit/{id}', [AdminController::class, 'subadmin_edit']);
	Route::post('subadmin-update', [AdminController::class, 'subadmin_update']);

	Route::get('customer-list', [AdminController::class, 'customer_list']);
	Route::get('customer-edit/{id}', [AdminController::class, 'customer_edit']);
	Route::post('customer-update', [AdminController::class, 'customer_update']);
	Route::get('customer-block/{id}/{status}', [AdminController::class, 'customer_block']);
	Route::get('customer-delete/{id}', [AdminController::class, 'customer_delete']);

	Route::get('permission', [AdminController::class, 'permission']);
	Route::get('permission-add', [AdminController::class, 'permission_add']);
	Route::post('add_permission', [AdminController::class, 'add_permission']);
	Route::get('permission-edit/{id}', [AdminController::class, 'permission_edit']);
	Route::post('permission-update', [AdminController::class, 'permission_update']);
	Route::get('permission-delete/{id}', [AdminController::class, 'permission_delete']);
	Route::get('permission-block/{id}/{status}', [AdminController::class, 'permission_block']);

	 //Standar thobe style managment
	 Route::get('thobe-model-list', [ProductController::class, 'thobe_model_list']);
	 Route::get('thobe-model-add', [ProductController::class, 'thobe_model_add']);
	 Route::post('thobe-add-model', [ProductController::class, 'thobe_add_model']);
	 Route::get('thobe-model-edit/{id}', [ProductController::class, 'thobe_model_edit']);
	 Route::post('thobe-model-update', [ProductController::class, 'thobe_model_update']);
	 Route::get('thobe-model-delete/{id}', [ProductController::class, 'thobe_model_delete']);
 
	 Route::get('thobe-fabric-list', [ProductController::class, 'thobe_fabric_list']);
	 Route::get('thobe-fabric-add', [ProductController::class, 'thobe_fabric_add']);
	 Route::post('thobe-add-fabric', [ProductController::class, 'thobe_add_fabric']);
	 Route::get('thobe-fabric-edit/{id}', [ProductController::class, 'thobe_fabric_edit']);
	 Route::post('thobe-fabric-update', [ProductController::class, 'thobe_fabric_update']);
	 Route::get('thobe-fabric-delete/{id}', [ProductController::class, 'thobe_fabric_delete']);
 
	 Route::get('thobe-buttons-list', [ProductController::class, 'thobe_buttons_list']);
	 Route::get('thobe-buttons-add', [ProductController::class, 'thobe_buttons_add']);
	 Route::post('thobe-add-buttons', [ProductController::class, 'thobe_add_buttons']);
	 Route::get('thobe-buttons-edit/{id}', [ProductController::class, 'thobe_buttons_edit']);
	 Route::post('thobe-buttons-update', [ProductController::class, 'thobe_buttons_update']);
	 Route::get('thobe-buttons-delete/{id}', [ProductController::class, 'thobe_buttons_delete']);
 
	 Route::get('thobe-collar-list', [ProductController::class, 'thobe_collar_list']);
	 Route::get('thobe-collar-add', [ProductController::class, 'thobe_collar_add']);
	 Route::post('thobe-add-collar', [ProductController::class, 'thobe_add_collar']);
	 Route::get('thobe-collar-edit/{id}', [ProductController::class, 'thobe_collar_edit']);
	 Route::post('thobe-collar-update', [ProductController::class, 'thobe_collar_update']);
	 Route::get('thobe-collar-delete/{id}', [ProductController::class, 'thobe_collar_delete']);


	 Route::get('thobe-pocket-list', [ProductController::class, 'thobe_pocket_list']);
	 Route::get('thobe-pocket-add', [ProductController::class, 'thobe_pocket_add']);
	 Route::post('thobe-add-pocket', [ProductController::class, 'thobe_add_pocket']);
	 Route::get('thobe-pocket-edit/{id}', [ProductController::class, 'thobe_pocket_edit']);
	 Route::post('thobe-pocket-update', [ProductController::class, 'thobe_pocket_update']);
	 Route::get('thobe-pocket-delete/{id}', [ProductController::class, 'thobe_pocket_delete']);
 
 
	 Route::get('thobe-cuff-list', [ProductController::class, 'thobe_cuff_list']);
	 Route::get('thobe-cuff-add', [ProductController::class, 'thobe_cuff_add']);
	 Route::post('thobe-add-cuff', [ProductController::class, 'thobe_add_cuff']);
	 Route::get('thobe-cuff-edit/{id}', [ProductController::class, 'thobe_cuff_edit']);
	 Route::post('thobe-cuff-update', [ProductController::class, 'thobe_cuff_update']);
	 Route::get('thobe-cuff-delete/{id}', [ProductController::class, 'thobe_cuff_delete']);


	 Route::get('thobe-front-style-list', [ProductController::class, 'thobe_front_style_list']);
	 Route::get('thobe-front-style-add', [ProductController::class, 'thobe_front_style_add']);
	 Route::post('thobe-add-front-style', [ProductController::class, 'thobe_add_front_style']);
	 Route::get('thobe-front-style-edit/{id}', [ProductController::class, 'thobe_front_style_edit']);
	 Route::post('thobe-front-style-update', [ProductController::class, 'thobe_front_style_update']);
	 Route::get('thobe-front-style-delete/{id}', [ProductController::class, 'thobe_front_style_delete']);
 
 
	 /////////Coupon Managements////////////
	 Route::get('coupon/status/{type}/{id}',[CouponController::class,'pincode_status']);
	 Route::resource('coupons', CouponController::class);

	     ///////////Settings Route//////////////
		 Route::get('faq',[SettingController::class,'manage_faq'])->name('faq');
		 Route::post('faq_update',[SettingController::class,'update_faq']);
		 Route::get('privacy-policy',[SettingController::class,'manage_policy'])->name('policy');
		 Route::post('policy_update',[SettingController::class,'update_policy']);
		 Route::get('about_us',[SettingController::class,'manage_about'])->name('about_us');
		 Route::post('about_update',[SettingController::class,'update_about']);
		 Route::get('terms',[SettingController::class,'manage_terms'])->name('terms');
		  Route::post('terms_update',[SettingController::class,'update_terms']);
		 Route::resource('setting', SettingController::class);



		 /////////Manage shipping////////////
	 Route::get('/manage_pin',[ProductController::class,'getshipping']);
	 Route::post('add-pin',[ProductController::class,'add_pincode']);
	//  Route::get('category/status/{type}/{id}',[CategoryController::class,'status']);
	 Route::get('pincode/status/{type}/{id}',[ProductController::class,'pincode_status']);
 Route::get('pincode-delete/{id}',[ProductController::class,'pincode_delete']);



//////////////////orders Route/////////////////////
Route::get('order-list',[OrderController::class,'all_orders'])->name('order_list');

Route::get('delay-order-list',[OrderController::class,'delay_order'])->name('delay_order');
Route::get('update-status/{status}/{id}',[OrderController::class,'update_status']);
Route::get('view-detail/{id}',[OrderController::class,'view_detail']);
Route::post('suborderworkstatus', [OrderController::class, 'suborderworkstatus']);
Route::get('update_delivery/{status}/{id}',[OrderController::class,'update_delivery_status']);
Route::get('ongoing-order',[OrderController::class,'all_ongoing_orders'])->name('order_ongoing');
Route::get('total/order',[OrderController::class,'total_order']);
Route::get('pending/order',[OrderController::class,'pending_order']);
Route::get('confirm/order',[OrderController::class,'confirm_order']);
Route::get('cancel/order',[OrderController::class,'cancel_order']);
Route::get('delivered/order',[OrderController::class,'delivered_order']);
///////////Notification Route///////////////

Route::get('/send-notification', [HomeController::class, 'index'])->name('home');
// Route::post('/save-token', [HomeController::class, 'saveToken'])->name('save-token');
Route::post('/send-notification', [HomeController::class, 'sendNotification'])->name('send.notification');
//////////////Measurement/////////////
Route::get('measurement/status/{type}/{id}',[MeasurementController::class,'measurement_status']);
Route::resource('measurement', MeasurementController::class);
Route::resource('branch', BranchController::class);

});