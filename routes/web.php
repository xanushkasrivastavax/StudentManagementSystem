<?php

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

// use Illuminate\Routing\Route;

use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('isadmin')->group(function () {
    Route::get('/user','HomeController@addUser');
});

Route::middleware('checkauth')->group(function () {
    Route::get('/cinfo', 'CourseController@getCourse');
    Route::get('/edituser/{id}', 'HomeController@edituser');
    Route::get('/delete/{id}', 'HomeController@delete');
    Route::get('/student', 'HomeController@getStudent');
    Route::get('/landing', 'HomeController@landing');
    Route::any('/course', 'CourseController@handle');
    Route::patch('/edituser/{id}', 'HomeController@postedit');
    Route::get('/editcourse/{id}', 'CourseController@editcourse');
    Route::patch('/editcourse/{id}', 'CourseController@postedit');
    Route::get('/display', 'HomeController@display');
    Route::get('/display', 'HomeController@student');
    Route::get('/tdisplay', 'HomeController@teacher');
    Route::get('/teacher', 'HomeController@teacherdisplay');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@count');


