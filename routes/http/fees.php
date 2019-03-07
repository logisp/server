<?php

Route::middleware('auth:admin')->group(function () {
  Route::post('fees/create', 'FeeController@create')->middleware('test');
  Route::post('fees/delete', 'FeeController@delete')->middleware('test');
  Route::post('fees/points/update', 'FeeController@updatePoints');
  Route::post('fees/comment/update', 'FeeController@updateComment');
});
