<?php

Route::get('usersettings', 'UserSettingsController@index');
Route::get('usersettings/create', 'UserSettingsController@create');
Route::get('user/settings/all', 'UserSettingsController@Settings');
Route::get('/user/settings', 'UserSettingsController@allSettings');
Route::get('/user/getSettings', 'UserSettingsController@getSettings');
Route::get('/user/settings/{settings}/edit', 'UserSettingsController@edit');
Route::post('/user/settings/store', 'UserSettingsController@store');

Route::get('/settings/delete/{settings}', 'UserSettingsController@delete');
Route::post('/settings/delete/{settings}', 'UserSettingsController@destroy');

