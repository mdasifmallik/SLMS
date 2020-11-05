<?php

use App\Batch;
use App\User;
use Carbon\Carbon;

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
    return redirect('/student_dash');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return redirect('/student_dash');
});


Route::resources([
    //'/' => 'HomepageController',
    'register' => 'RegisterController',
    'student_dash' => 'StudentdashController',
    'admin_dash' => 'AdmindashController',
    'department' => 'DepartmentController',
    'lecturer' => 'LecturerController',
    'batch' => 'BatchController',
    'student_application' => 'StudentApplicationController',
    'admin_application' => 'AdminApplicationController',
    'leave_management' => 'LeaveManagementController',
    'settings' => 'SettingsController',
]);

Route::get('/register_lecturer', 'RegisterController@register_lecturer');
Route::post('/store_lecturer', 'RegisterController@store_lecturer');
Route::post('/store_student', 'RegisterController@store_student');
Route::get('/destroy_lecturer/{id}', 'LecturerController@destroy_lecturer');
Route::post('/store_head', 'StudentApplicationController@store_head');
Route::get('/current_leave', 'StudentApplicationController@current_leave');
Route::get('/leave_history', 'StudentApplicationController@leave_history');
Route::get('/approve/{id}', 'AdminApplicationController@approve');
Route::get('/decline/{id}', 'AdminApplicationController@decline');
Route::get('/approved_leaves', 'AdminApplicationController@approved_leaves');
Route::get('/not_approved_leaves', 'AdminApplicationController@not_approved_leaves');
Route::get('/on_leave', 'AdminApplicationController@on_leave');
Route::get('/delete_student/{id}', 'BatchController@delete_student');
Route::get('/delete_batch/{id}', 'BatchController@delete_batch');
Route::get('/delete_leave_record', 'LeaveManagementController@delete_leave_record');
Route::get('/delete_leave_history', 'LeaveManagementController@delete_leave_history');


Route::get('/logout', function () {
    Auth::logout();
  	return redirect('/login');
});



Route::get('/test', function () {
    $mytime = Carbon::now(+6);
    $ldate = date('Y_m_d')."/".date('H_i_s');
    echo $mytime->toDateString();
});