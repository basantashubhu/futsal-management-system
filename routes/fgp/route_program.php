<?php

// current program setup page
Route::get('program-setup', 'ProgramShowController@program');

// new properties table data
Route::get('program/new-properties', 'ProgramShowController@newProperties');

// new property add form on fly
Route::get('program/properties/new', 'ProgramShowController@addForm');

// new property store in db
Route::post('program/properties/save-new', 'ProgramAddUpdateController@save');

// update property form
Route::get('program/properties/{property}/update', 'ProgramShowController@editForm');

// update property in db
Route::post('program/properties/{property}/save', 'ProgramAddUpdateController@update');

// delete property from db
Route::post('program/properties/{property}/delete', 'ProgramAddUpdateController@delete');
