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

Route::resource('personal', 'StudentController');
Route::resource('class', 'ClassController');
Route::get('class/{classId}/students', 'ClassController@getStudents')->name('class.students');;
