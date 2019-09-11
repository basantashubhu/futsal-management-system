<?php


Route::get('/textLog','TextLogController@index');
Route::get('/textLog/all','TextLogController@getAll');
Route::get('/textLog/view/{reportLog}','TextLogController@viewLog');
Route::get('/textLog/downLoad/{reportLog}','TextLogController@downLoadLog');

Route::get('/textLog/readMonitor/{field}','TextLogController@readLogMonitor');