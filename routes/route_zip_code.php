<?php


Route::get('/zip_code', 'ZipCodeController@index');
Route::get('/zip_code/all','ZipCodeController@getAll');

/*-----------------------------------------------------------------
|           zip_code Add Route                                 |
------------------------------------------------------------------*/
Route::get('/addZipCode', 'ZipCodeController@create');
Route::get('/addZipCode1', 'ZipCodeController@create1');
Route::post('/zip_code/add','ZipCodeController@store');
Route::get('/zip_code/{id}','ZipCodeController@getDetail');
Route::get('/zip_code/city/{cityId}','ZipCodeController@getCityDetail');

/*-------------------------------------------------------------------
|           zip_code Edit Route                                  |
----------------------------------------------------------------------*/
Route::get('/zip_code/edit/{zip_code}','ZipCodeController@edit');
Route::post('/zip_code/update/{zip_code}','ZipCodeController@update');

/*-------------------------------------------------------------------
|           zip_code Access From Everywhere                          |
----------------------------------------------------------------------*/
Route::get('/zip_code/getData/{zip_code_val}/{query?}','ZipCodeController@getData');

Route::get('/lookup/zip/all','ZipCodeController@selectall');
/*-------------------------------------------------------------------
|           zip_code mass delete                |
----------------------------------------------------------------------*/
Route::get('massDeleteZip', 'ZipCodeController@massDelete');
Route::post('generateDeletingData', 'ZipCodeController@generateDeletingData');
Route::post('deleteAll', 'ZipCodeController@deleteAll');

/*-------------------------------------------------------------------
|           Access From Everywhere                          |
----------------------------------------------------------------------*/
Route::get('getCity', 'ZipCodeController@getCity');