<?php

// Route::middleware('auth')->group(function () {
//   Route::post('points/order/delete', 'PointController@deleteOrder')->middleware('test');
// });

// Route::middleware('auth:admin')->group(function () {
//   Route::post('points/orders/admin/search', 'PointController@adminSearchOrders');
//   Route::post('points/adjust', 'PointController@adminAdjust');
//   Route::post('points/order/confirm', 'PointController@adminConfirmOrder');
// });

// Route::middleware('auth:user')->group(function () {
//   Route::post('points/orders/user/search', 'PointController@userSearchOrders');
//   Route::post('points/order/create', 'PointController@userCreateOrder');
//   Route::post('points/recharge', 'PointController@userRecharge');
// });

Route::middleware('auth')->group(function () {
  Route::post('user/points/logs/search', 'PointController@searchUserLogs');
});
