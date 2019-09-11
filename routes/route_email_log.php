<?php


Route::get('/email_log', 'EmailLogController@index');
Route::get('email_log/all','EmailLogController@getAll');

//
Route::get('/email_log/{table}/{table_id}', 'EmailLogController@getAllLogs');

Route::get('/viewSingleEmailLog/{id}', 'EmailLogController@viewSingle');
