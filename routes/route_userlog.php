<?php


Route::any('/userlog/ping','SessionController@ping');


Route::get('/userlogs','SessionController@index');

Route::post('/userlog/kickout/{id}','SessionController@kickOut');

Route::get('/userlogs/all','SessionController@allSessions');

Route::get('/userlogs/remove/{id}','SessionController@removeSession');
Route::get('/userlogs/lock/{id}','SessionController@lockOut');
Route::post('/userlogs/lock/{user}','SessionController@lock');


Route::get('/userlogs/unlock/{id}','SessionController@unlock');
Route::post('/userlogs/unlock/{user}','SessionController@unlockUser');