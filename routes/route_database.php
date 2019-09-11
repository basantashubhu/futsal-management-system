<?php

Route::get('/database','DatabaseController@index');
Route::get('/database/getAll','DatabaseController@getAll');
Route::get('/database/restoreConfirm/{timeStamp}','DatabaseController@restoreConfirm');
Route::get('/database/restore/{timeStamp}','DatabaseController@restore');

Route::get('/database/backupConfirm','DatabaseController@backupConfirm');
Route::post('/database/backup','DatabaseController@backUpDB');