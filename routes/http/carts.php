<?php

Route::middleware('auth:user')->group(function () {
  Route::post('cart/add', 'CartController@add');
  Route::post('cart/get', 'CartController@search');
  Route::post('cart/delete', 'CartController@delete');
  Route::post('cart/update', 'CartController@update');
});
