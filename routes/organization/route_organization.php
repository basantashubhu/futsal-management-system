<?php

Route::get('organizations', 'OrganizationShowController@index');

Route::get('organizations/select2', 'OrganizationDataController@select2');

Route::get('organizations/create', 'OrganizationShowController@create');
Route::post('organizations/store', 'OrganizationStoreController@store');
