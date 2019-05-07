<?php

Route::post('user/register/email', 'UserController@createUserByEmail');

Route::middleware('auth:user')->group(function () {
  Route::post('user/delete/email', 'UserController@deleteByEmail')->middleware('test');
  Route::post('user/personal/get', 'UserController@getPersonal');
  Route::post('user/personal/update', 'UserController@updatePersonal');
});

Route::middleware('auth:admin')->group(function () {
  Route::post('admin/users/search', 'UserController@adminSearch');
});

Route::middleware('auth')->group(function () {
  Route::post('user/title/get', 'UserController@getTitle');
});
