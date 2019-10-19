<?php

Route::get('organizations', 'OrganizationShowController@index');
Route::get('organizations/getData', 'OrganizationDataController@getData');

Route::get('organizations/select2', 'OrganizationDataController@select2');

// create route
Route::get('organizations/create', 'OrganizationShowController@create');
Route::post('organizations/store', 'OrganizationStoreController@store');

// edit route
Route::get('organizations/{organization}/edit', 'OrganizationShowController@edit');
Route::post('organizations/{organization}/update', 'OrganizationStoreController@update');

// addr & contact
Route::get('organizations/{organization}/{relation}', 'OrganizationDataController@getRelation');
