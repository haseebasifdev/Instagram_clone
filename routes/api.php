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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/follow', 'FollowerController@store');
Route::get('/notfollwer/{user}', 'FollowerController@show');
Route::get('/allfriends', 'FollowerController@friends');
Route::post('/allmessages/{user}', 'MessageController@show');

Route::get('/user/{user}', 'UserController@show');
Route::get('/alluser/{user}', 'UserController@index');
Route::post('/updateprofile/{user}', 'UserController@update');
Route::post('/updatedprofilepicture/{user}', 'UserController@updateprofilepicture');
Route::post('/post', 'PostController@store');
Route::get('/post/{post}', 'PostController@show');
Route::get('/allpost', 'PostController@index');
Route::post('/addcomment', 'CommentController@store');
Route::post('/addlike', 'LikeController@store');
