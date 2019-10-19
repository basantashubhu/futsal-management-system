<?php

Route::get('courts', 'CourtShowController@index');
Route::get('courts/getData', 'CourtDataController@getData');

// create court
Route::get('courts/create', 'CourtShowController@create');
Route::post('courts/store', 'CourtStoreController@store');

// court edit
Route::get('courts/{court}/edit', 'CourtShowController@edit');
Route::post('courts/{court}/update', 'CourtStoreController@update');
