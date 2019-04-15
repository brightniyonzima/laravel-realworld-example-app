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
    return view('auth.login');
});

Route::resource('articles', 'ArticlesController');
Route::resource('categories', 'CategoriesController');
Route::post('categories/restore/{id}','CategoriesController@restore')->name('categories.restore');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
