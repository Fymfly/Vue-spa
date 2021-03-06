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

// 显示商品
Route::get('/goods', 'GoodsController@index');

// 注册
Route::post('members','MemberController@insert');

// 登录
Route::post('authorizations','MemberController@login');

// 令牌
Route::middleware(['jwt'])->group( function () {

    // 收件人地址-显示
    Route::get('address','AddressController@index');
    // 收件人地址-添加
    Route::post('address','AddressController@insert');


    // 下订单
    Route::post('orders', 'OrderController@insert');

    // 获取我的订单信息
    Route::get('orders', 'OrderController@index');    

    
});


// 生成订单号
Route::get('testSN', function() {
    return getOrderSN();
});