<?php

Route::get('/', 'TestController@root');

Route::post('auth/user/email', 'AuthController@generateUserTokenByEmail');
Route::post('auth/admin/username', 'AuthController@generateAdminTokenByUsername');

Route::post('auth/token/check', 'AuthController@checkToken')->middleware('auth');
