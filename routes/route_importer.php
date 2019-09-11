<?php

Route::get('/importer', 'ImportController@index');
Route::get('/importer/uploadcsv', 'ImportController@upload');
Route::post('/importer/uploadcsv', 'ImportController@uploadCSV');

// dynamic heades
Route::post('importer/uploadcsv-headers', 'ImportController@mapCsvHeaders');

Route::get('/importer/sample/{name}', 'ImportController@downloadSample');

/*----------------------------------------------------------------------------
Upload Application & Importer Route
------------------------------------------------------------------------------*/
Route::get('/importer/upload/{field}', 'ApplicationImportController@uploadFileModal');
Route::post('/importer/application/uploadcsv', 'ApplicationImportController@importData');

Route::get('/importer/monitor/{field}', 'ImportController@getMonitor');
Route::get('/importer/application/runQueue', 'ApplicationImportController@runQueue');

/*------------- data export ---------------*/
Route::get('/export/volunteer', 'ExportController@volunteerExporter');

Route::get('download_csv/{file_name}', 'ExportController@exportCSV');
