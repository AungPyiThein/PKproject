<?php

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


Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::get('/category/{id}','HomeController@showCates');
Route::get('/posts/{id}', 'PostsController@addViewCount');

Route::get('/mostview', 'PostsController@mostView');
Route::get('/create', 'PostsController@create');
/*

Route::get('/Hello', function () {
    return  '<h1>Hello World</h1>';
});

Route::get('/about', function () {
    return view('about');
});
*/


Route::get('/search','PostsController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::resource('/posts', 'PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
