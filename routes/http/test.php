<?php

Route::get('test/debug', 'TestController@testDebug')->middleware('debug');

/**
 * 下面这些路由只会在测试环境下生成
 * 利用这些路由可以测试中间件等复杂模块
 */
Route::middleware('test')->group(function () {
  Route::get('test/test', 'TestController@testDebug');
  Route::post('auth/user/check', 'AuthController@checkToken')->middleware('auth:user');
  Route::post('auth/admin/check', 'AuthController@checkToken')->middleware('auth:admin');
  Route::post('auth/user/role/root/check', 'AuthController@checkRootRole')->middleware('auth:user,root');
  Route::post('auth/user/role/fail/check', 'AuthController@checkRootRole')->middleware('auth:user,fail');
});
