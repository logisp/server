<?php

Route::get('test/debug', 'TestController@testDebug')->middleware('debug');

Route::middleware('test')->group(function () {
  Route::get('test/test', 'TestController@testDebug');

  /**
   * 提供测试路由验证 auth middleware 的正确性
   */
  Route::post('auth/user/check', 'AuthController@checkToken')->middleware('auth:user');
  Route::post('auth/admin/check', 'AuthController@checkToken')->middleware('auth:admin');
  Route::post('auth/user/role/check', 'AuthController@checkRootRole')->middleware('auth:user');
});
