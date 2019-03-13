<?php

Route::post('user/register/email', 'UserController@createUserByEmail');

Route::middleware('auth:user')->group(function () {
  Route::post('user/delete', 'UserController@delete')->middleware('test');
});
