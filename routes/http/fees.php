<?php

Route::post('fees/all', 'FeeController@all')->middleware('auth');

Route::middleware('auth:admin')->group(function () {
  Route::post('fees/points/update', 'FeeController@updatePoints');
  Route::post('fees/logs/search', 'FeeController@searchLogs');
  // Route::post('fees/comment/adjust', 'FeeController@adjustComment');
});
