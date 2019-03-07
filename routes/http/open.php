<?php

Route::get('/', 'TestController@root');

Route::post('user/register/email', 'UserController@createByEmail');
Route::post('user/auth/email', 'AuthController@generateUserTokenByEmail');
Route::post('admin/auth/username', 'AuthController@generateAdminTokenByUsername');

Route::post('auth/check', 'AuthController@checkToken')->middleware('auth');
Route::post('auth/refresh', 'AuthController@refresh')->middleware('auth');
