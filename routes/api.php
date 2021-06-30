<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\Dashboard;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Thobe;
use App\Http\Controllers\API\Exam;
use App\Http\Controllers\API\MockExam;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [LoginController::class, 'register']);
Route::post('otp_verified', [LoginController::class, 'otp_verified']);
Route::post('reset_otp_verified', [LoginController::class, 'reset_otp_verified']);
Route::post('reset_password', [LoginController::class, 'reset_password']);
Route::post('login', [LoginController::class, 'login']);
Route::post('update_profile', [LoginController::class, 'update_profile']);
Route::post('forgot_password', [LoginController::class, 'forgot_password']);
Route::post('add_address', [LoginController::class, 'add_address']);
Route::post('update_address', [LoginController::class, 'update_address']);
Route::get('get_profile', [LoginController::class, 'get_profile']);
Route::get('get_address', [LoginController::class, 'get_address']);
Route::get('get_category', [UserController::class, 'get_category']);
Route::get('get_sliders', [UserController::class, 'get_sliders']);

Route::get('about_us', [UserController::class, 'about_us']);
Route::get('terms', [UserController::class, 'terms']);
Route::get('privacy', [UserController::class, 'privacy']);
Route::get('faq', [UserController::class, 'faq']);

Route::get('get_banner', [UserController::class, 'get_banner']);
Route::get('products/{id}', [UserController::class, 'products']);
Route::get('products_details/{id}', [UserController::class, 'products_details']);
Route::get('search_products/{search}', [UserController::class, 'search_products']);
Route::post('add_to_cart', [UserController::class, 'add_to_cart']);
Route::post('thobe_cart', [Thobe::class, 'thobe_cart']);
Route::get('get_cart', [UserController::class, 'get_cart']);
Route::post('remove_cart', [UserController::class, 'remove_cart']);
Route::post('review_add', [UserController::class, 'review_add']);

Route::get('gifts', [UserController::class, 'gifts']);
Route::get('offers', [UserController::class, 'offers']);
Route::get('gift_description/{id}', [UserController::class, 'gift_description']);
Route::post('gift_create', [UserController::class, 'gift_create']);
Route::post('coupon', [UserController::class, 'coupon']);
Route::post('order', [UserController::class, 'order']);
Route::post('thobe_cart_quantity', [UserController::class, 'thobe_cart_quantity']);

Route::get('order_history', [UserController::class, 'order_history']);
Route::get('get_gift_carts/{order_id?}', [UserController::class, 'get_gift_carts']);
Route::get('previous_order', [UserController::class, 'previous_order']);
Route::get('track_order/{orderid}', [UserController::class, 'track_order']);
Route::get('fabric', [Thobe::class, 'fabric']);
Route::get('collar', [Thobe::class, 'collar']);
Route::get('cuffs', [Thobe::class, 'cuffs']);
Route::get('pocket', [Thobe::class, 'pocket']);
Route::get('button', [Thobe::class, 'button']);
Route::get('thobe-model',[Thobe::class,'thobe_model']);
Route::get('placket', [Thobe::class, 'placket']);
Route::get('ongoing_appointment', [Thobe::class, 'ongoing_appointment']);
Route::get('older_appointment', [Thobe::class, 'older_appointment']);
Route::get('branch', [Thobe::class, 'branch']);
Route::get('measurments', [Thobe::class, 'measurments']);
Route::get('loyalitys', [Thobe::class, 'loyalitys']);
Route::get('loyalitys_apply', [Thobe::class, 'loyalitys_apply']);
Route::post('contact_us', [Thobe::class, 'contact_us']);
Route::post('request_invoice', [Thobe::class, 'request_invoice']);
Route::get('getnotification',[NotificationController::class,'getAllNotificationsbyuser']);
Route::get('apikey', [Thobe::class, 'apikey']);
Route::get('termsandcondition', [Thobe::class, 'termsandcondition']);







