<?php

Route::post('user/register/email', 'UserController@createUserByEmail');

Route::middleware('auth:user')->group(function () {
  Route::post('user/delete/email', 'UserController@deleteByEmail')->middleware('test');
  Route::post('user/personal/get', 'UserController@getPersonal');
  Route::post('user/personal/update', 'UserController@updatePersonal');
});
