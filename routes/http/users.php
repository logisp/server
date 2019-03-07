<?php

Route::middleware('auth:user')->group(function () {
  Route::post('user/delete', 'UserController@delete')->middleware('test');
});
