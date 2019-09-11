<?php


Route::get('lookup', 'LookupsController@index');
Route::get('lookup/all','LookupsController@getAll');
Route::get('lookup/search-section','LookupsController@list');



/*-----------------------------------------------------------------
|           Lookup Add Route                                 |
------------------------------------------------------------------*/
Route::get('/addLookup', 'LookupsController@create');
Route::post('/lookup/add','LookupsController@store');

/*-------------------------------------------------------------------
|           Lookup Edit Route                                  |
----------------------------------------------------------------------*/
Route::get('/lookup/edit/{lookup}','LookupsController@edit');
Route::post('/lookup/update/{lookup}','LookupsController@update');

/*-------------------------------------------------------------------
|           Lookup Access From Everywhere                          |
----------------------------------------------------------------------*/
Route::get('/lookup/getData/{lookup_val}','LookupsController@getData');
Route::get('/lookup/getData/{lookup_val}/{value}','LookupsController@getTypeData');
Route::get('lookup/get/code','LookupsController@getCode');


Route::get('lookup/get/{code}','LookupsController@viewCode');
Route::get('lookup/code/{code}','LookupsController@getSpecifiesData');
Route::get('lookup/add/{code}','LookupsController@createCode');

//Lookup single
Route::get('lookup/singleView/{id}', 'LookupsController@singleView');
Route::get('lookup/addValue/{id}', 'LookupsController@addValue');
Route::get('lookup/addCode/{id}', 'LookupsController@addCode');

//lookup Delete
Route::get('lookup/delete/{lookup}', 'LookupsController@delete');
Route::post('lookup/destroy/{lookup}', 'LookupsController@destroy');

Route::get('lookup/county/list', 'LookupsController@countyList');
