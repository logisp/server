<?php

// Route::middleware('auth')->group(function () {
//   Route::post('orders/find', 'CommodityOrderController@find');
// });

Route::middleware('auth:user')->group(function () {
  Route::post('cart/order', 'OrderController@createFromCart');
  Route::post('order/post', 'OrderController@post');
  Route::post('order/confirming', 'OrderController@confirming');
  Route::post('order/abandon', 'OrderController@abandon');
  Route::post('order/user/search', 'OrderController@userSearch');
  Route::post('order/delete', 'OrderController@delete');
});

Route::middleware('auth:admin')->group(function () {
  Route::post('order/inbound', 'OrderController@inbound');
  Route::post('order/confirm', 'OrderController@confirm');
  Route::post('order/abandoned', 'OrderController@abandoned');
  Route::post('order/admin/search', 'OrderController@adminSearch');
});

// Route::middleware('auth:user')->group(function () {
//   Route::post('commodity/orders/user/search', 'CommodityOrderController@userSearch');

//   Route::post('commodity/order/create', 'CommodityOrderController@create');
//   Route::post('commodity/order/delete', 'CommodityOrderController@delete');

//   Route::post('commodity/order/inbound/logistic/update', 'CommodityOrderController@updateInboundLogisticId');
//   Route::post('commodity/order/abandon', 'CommodityOrderController@abandon');
//   Route::post('commodity/order/discrepant/update', 'CommodityOrderController@updateDiscrepant');
//   Route::post('commodity/order/outbound/individual', 'CommodityOrderController@outboundIndividual');
// });

// Route::middleware('auth:admin')->group(function () {
//   Route::post('commodity/orders/admin/search', 'CommodityOrderController@adminSearch');

//   Route::post('commodity/order/inbound', 'CommodityOrderController@inbound');
//   Route::post('commodity/order/discrepant', 'CommodityOrderController@discrepant');
//   Route::post('commodity/order/abandon/confirm', 'CommodityOrderController@confirmAbandoned');
//   Route::post('commodity/order/discrepant/confirm', 'CommodityOrderController@confirmDiscrepant');

//   Route::post('commodity/order/outbound', 'CommodityOrderController@outbound');
//   Route::post('commodity/order/outbound/cancel', 'CommodityOrderController@cancelOutbound');
// });
