<?php

Route::get('draft/saveConfirm/{target}','DraftController@saveConfirm');
Route::post('draft/save/{target}','DraftController@store');
Route::get('/draft/load/{target}','DraftController@load');
Route::get('/draft/getContent/{draft}','DraftController@getById');
