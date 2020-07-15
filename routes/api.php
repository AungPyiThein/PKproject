<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/createpost', 'API\PostsController@store');
Route::post('/updatepost', 'API\PostsController@update');
Route::post('/detailPost', 'API\PostsController@detailPost');
Route::post('/delePost', 'API\PostsController@destroy');
Route::post('/viewPost', 'API\PostsController@addViewCount');
Route::post('/mostviewPost', 'API\PostsController@mostView');
Route::post('/searchpost', 'API\PostsController@search');
// Route::post('/createpost',function(){
// 	return response()->json('here');
// });

