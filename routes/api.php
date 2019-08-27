<?php

use Illuminate\Http\Request;

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

Route::group(['prefix'=>'adminpanel',],function(){

Route::apiResource('user','UserController');//->except('show');
Route::apiResource('role','RoleController');//->except('show');

Route::apiResource('page','PageController');//->except('update');
Route::apiResource('layout','LayoutController');//->except('update');
Route::apiResource('component','ComponentController')->except('update');


Route::apiResource('button','ButtonController');//->except('show');
Route::apiResource('video','VideoController');//->except('show');
Route::apiResource('text','TextController');//->except('show');
Route::apiResource('slider','SliderController');//->except('show');
Route::apiResource('picture','PictureController');//->except('show');
Route::apiResource('post','PostController');//->except('show');

});

