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

Route::get('/', function () {
// 进入欢迎界面laravel;
    return view('welcome');
});
//get/post/any 接值方式
Route::any('login', 'StudentController@login');
Route::any('index', 'StudentController@index');
Route::any('add', 'StudentController@add');  
Route::any('delete', 'StudentController@delete');  
Route::any('update', 'StudentController@update');  
Route::any('up', 'StudentController@up');  
Route::any('rediss', 'StudentController@rediss');