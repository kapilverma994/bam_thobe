<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

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
});


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
   // Route::get('dashboard', [AdminController::class, 'index']);
	Route::get('dashboard', function () {
    		return view('admin/dashboard');
	});
		
	Route::get('course', [AdminController::class, 'index']);
	Route::get('course_list', [AdminController::class, 'course_list']);
	Route::post('coursesave', [AdminController::class, 'coursesave']);

	Route::get('category', [AdminController::class, 'category']);
	Route::get('category-add', [AdminController::class, 'category_add']);
	Route::post('add_categories', [AdminController::class, 'add_categories']);
	Route::get('category-edit/{id}', [AdminController::class, 'category_edit']);
	Route::get('category-delete/{id}', [AdminController::class, 'category_delete']);
	Route::get('category-block/{id}/{status}', [AdminController::class, 'category_block']);
	Route::post('category_update', [AdminController::class, 'category_update']);

	Route::get('mock-category', [AdminController::class, 'mock_category']);
	Route::get('mock-category-add', [AdminController::class, 'mock_category_add']);
	Route::post('mock_add_categories', [AdminController::class, 'mock_add_categories']);
	Route::get('mock-category-edit/{id}', [AdminController::class, 'mock_category_edit']);
	Route::get('mock-category-delete/{id}', [AdminController::class, 'mock_category_delete']);
	Route::get('mock-category-block/{id}/{status}', [AdminController::class, 'mock_category_block']);
	Route::post('mock_category_update', [AdminController::class, 'mock_category_update']);

	Route::get('sub-category', [AdminController::class, 'sub_category']);
	Route::get('sub-category-add', [AdminController::class, 'sub_category_add']);
	Route::post('add_sub_categories', [AdminController::class, 'add_sub_categories']);
	Route::get('sub-category-edit/{id}', [AdminController::class, 'sub_category_edit']);
	Route::post('sub_category_update', [AdminController::class, 'sub_category_update']);
	Route::get('sub-category-delete/{id}', [AdminController::class, 'sub_category_delete']);
	Route::get('sub-category-block/{id}/{status}', [AdminController::class, 'sub_category_block']);


	Route::get('mock-sub-category', [AdminController::class, 'mock_sub_category']);
	Route::get('mock-sub-category-add', [AdminController::class, 'mock_sub_category_add']);
	Route::post('mock_add_sub_categories', [AdminController::class, 'mock_add_sub_categories']);
	Route::get('mock-sub-category-edit/{id}', [AdminController::class, 'mock_sub_category_edit']);
	Route::post('mock_sub_category_update', [AdminController::class, 'mock_sub_category_update']);
	Route::get('mock-sub-category-delete/{id}', [AdminController::class, 'mock_sub_category_delete']);
	Route::get('mock-sub-category-block/{id}/{status}', [AdminController::class, 'mock_sub_category_block']);

	Route::get('questions', [AdminController::class, 'questions']);
	Route::get('questions-add', [AdminController::class, 'questions_add']);
	Route::post('add_questions', [AdminController::class, 'add_questions']);
	Route::post('add_questions_get_subcat', [AdminController::class, 'add_questions_get_subcat']);
	Route::get('questions-edit/{id}', [AdminController::class, 'questions_edit']);
	Route::post('questions_update', [AdminController::class, 'questions_update']);
	Route::get('questions-delete/{id}', [AdminController::class, 'questions_delete']);
	Route::get('questions-block/{id}/{status}', [AdminController::class, 'questions_block']);


	Route::get('mock-questions', [AdminController::class, 'mock_questions']);
	Route::get('mock-questions-add', [AdminController::class, 'mock_questions_add']);
	Route::post('mock_add_questions', [AdminController::class, 'mock_add_questions']);
	Route::post('mock_add_questions_get_subcat', [AdminController::class, 'mock_add_questions_get_subcat']);
	Route::get('mock-questions-edit/{id}', [AdminController::class, 'mock_questions_edit']);
	Route::post('mock_questions_update', [AdminController::class, 'mock_questions_update']);
	Route::get('mock-questions-delete/{id}', [AdminController::class, 'mock_questions_delete']);
	Route::get('mock-questions-block/{id}/{status}', [AdminController::class, 'mock_questions_block']);

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

	Route::get('subject', [AdminController::class, 'subject']);
	Route::get('subject_list', [AdminController::class, 'subject_list']);
	Route::post('subjectsave', [AdminController::class, 'subjectsave']);

	Route::get('permission', [AdminController::class, 'permission']);
	Route::get('permission-add', [AdminController::class, 'permission_add']);
	Route::post('add_permission', [AdminController::class, 'add_permission']);
	Route::get('permission-edit/{id}', [AdminController::class, 'permission_edit']);
	Route::post('permission-update', [AdminController::class, 'permission_update']);
	Route::get('permission-delete/{id}', [AdminController::class, 'permission_delete']);
	Route::get('permission-block/{id}/{status}', [AdminController::class, 'permission_block']);

	Route::get('dictionary', [AdminController::class, 'dictionary']);
	Route::get('dictionary-add', [AdminController::class, 'dictionary_add']);
	Route::post('add_dictionary', [AdminController::class, 'add_dictionary']);
	Route::get('dictionary-edit/{id}', [AdminController::class, 'dictionary_edit']);
	Route::post('dictionary-update', [AdminController::class, 'dictionary_update']);
	Route::get('dictionary-delete/{id}', [AdminController::class, 'dictionary_delete']);
	Route::get('dictionary-block/{id}/{status}', [AdminController::class, 'dictionary_block']);
	Route::get('practice-block/{id}/{status}', [AdminController::class, 'practice_block']);
});