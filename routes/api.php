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

Route::get('/test', function (){
   $array = ['test' => 'test1'];
   return json_encode($array);
});

//Route::get('/member/get/{id}', 'MemberController@get')->name('apiGetMember');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/member/add/{params}', 'MemberController@create');
    Route::get('/member/get/{id}', 'MemberController@get')->name('apiGetMember');
    Route::get('/member/update/{id}/{params}', 'MemberController@update');
    Route::get('/member/delete/{id}', 'MemberController@delete');
    Route::get('/member/get/party/{id}', 'MemberController@getParty');
});
