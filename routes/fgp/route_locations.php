<?php 

Route::get('view/location', 'LocationController');
Route::get('locations/table-data', 'LocationController@tableData');

Route::get('location/add', 'LocationController@addLocation');
Route::post('locations', 'LocationController@store');

Route::get('location/edit/{location}', 'LocationController@editLocation');
Route::get('location/delete/{location}', 'LocationController@deleteLocation');
Route::post('location/delete/{location}', 'LocationController@destroyLocation');