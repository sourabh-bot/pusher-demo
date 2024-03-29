<?php

// use Illuminate\Support\Facades\Auth;

use App\Notifications\EmailNotification;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Auth::routes();

Auth::routes();

// BroadCast::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post', 'PostController@index');

Route::get('post/update/', 'PostController@update');

Route::get('post/view', 'PostController@view')->middleware('can:view-post');

Route::get('send', 'BroadCastController@index');
Route::get('receive', 'BroadCastController@view');

Route::get('notification', function(){
    // echo dd(Notification::route('mail', 'shrimali.sourabh1967@gmail.com')->notify(new EmailNotification()));
    // return dd(Notification::route('database', 'shrimali.sourabh@yahoo.com')->notify(new EmailNotification("Welcome my friend welcome")));
    // Auth::user()->notify(new EmailNotification());
    Notification::route('slack', env('SLACK_HOOK'))->notify(new EmailNotification());
    return "Notification sent";

   

});


// Admin routes


// Route::get('admin')/


Route::get('admin/register', 'AdminController@index')->name('admin-regiter');

Route::post('admin/save', 'AdminController@save')->name('save');

Route::get('user-list', function(){
    return "User Lsit Page";
});

Route::get('admin/dashboard', function(){
    return "Dashboard page";
})->name('dashboard')->middleware('auth');

Route::get('admin/login', function(){
    return "Admin Login Page";
})->name('admin-login')->middleware('auth.admin');


// For student controller
Route::get('student', 'StudentController@index');
Route::post('student/create', 'StudentController@insert')->name('student-create');
Route::get('student/class/{id}', 'StudentController@getClassWithStudent');


// For class controller
Route::get('student/class', 'StudentClassController@index');
Route::post('student/class/create', 'StudentClassController@insert')->name('class-create');
Route::get('student/{id}', 'StudentClassController@getStudentWithClass');


// For Employee controller
Route::get('employee', 'Employee\EmployeeController@index');
Route::post('employee/add', 'Employee\EmployeeController@add')->name('add');
Route::get('employee/{id}', 'Employee\EmployeeController@show')->name('show');

// For Role controller
Route::get('employee-role', 'Employee\RoleController@index');
Route::post('employee-role/add', 'Employee\RoleController@add')->name('role-add');
Route::get('employee-role/{id}', 'Employee\RoleController@show');

// For Mechanic controller
Route::get('car/mechanic', 'Car\MechanicController@index');
Route::post('car/mechanic', 'Car\MechanicController@add' )->name('add');
Route::get('car/owner/{id}', 'Car\MechanicController@getCarOwner');

// For Car Controller
Route::get('car', 'Car\CarController@index');
Route::post('car/mechanic', 'Car\CarController@add' )->name('add-car');

Route::get('relation/user', 'Relation\MyUserController@index');
Route::get('relation/post', 'Relation\PostController@index');
Route::post('relation/user/create', 'Relation\MyUserController@create')->name('user-create');
Route::post('relation/post/create', 'Relation\PostController@create')->name('post-create');
Route::get('relation/user/image/{id}', 'Relation\MyUserController@getImg');
Route::get('relation/post/image/{id}', 'Relation\PostController@getImg');
Route::get('relation/image/{id}', 'Relation\ImageController@index');