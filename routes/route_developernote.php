<?php

Route::get('/developernote', 'DeveloperNoteController@index');
Route::get('/developernote/all', 'DeveloperNoteController@getNotes');
Route::get('/developernote/getAll', 'DeveloperNoteController@getAll');
Route::get('/developernote/export/{type}', 'DeveloperNoteController@export');
Route::post('/developernote/store', 'DeveloperNoteController@store');
Route::post('/developernote/pickup/{id}', 'DeveloperNoteController@pickupNote');
Route::post('/developernote/done/{id}', 'DeveloperNoteController@completeNote');
Route::get('/developernote/undone/{id}', 'DeveloperNoteController@undoneNote');
Route::post('/developernote/undone/{id}', 'DeveloperNoteController@unDone');


// developer note crud
Route::prefix('developer-note')->group(function() {
    Route::get('edit/{note}', 'DeveloperNoteController@editModal');
    Route::post('update/{note}', 'DeveloperNoteController@updateNote');
    Route::post('delete/{note}', 'DeveloperNoteController@deleteNote');

    Route::get('addClient/{note}', 'DeveloperNoteController@clientModal');
});