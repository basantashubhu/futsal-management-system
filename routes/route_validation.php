<?php


Route::get('/validation', 'ValidationController@index');
Route::get('/validation/all','ValidationController@getAll');

/*-----------------------------------------------------------------
|           validation Add Route                                 |
------------------------------------------------------------------*/
Route::get('/addValidation/{section?}', 'ValidationController@create');
Route::post('/validation/add','ValidationController@store');

/*-------------------------------------------------------------------
|           validation Edit Route                                  |
----------------------------------------------------------------------*/
Route::get('/validation/edit/{validation}','ValidationController@edit');
Route::post('/validation/update/{validation}','ValidationController@update');

//Single Validation
Route::get('validation/singleView/{id}', 'ValidationController@singleView');

/*
 * Validation code lookup by section
 * */
Route::get('validations/code/{section}/{code?}', 'ValidationController@code');