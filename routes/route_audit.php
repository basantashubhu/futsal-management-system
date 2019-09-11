<?php


Route::get('/audits/all/{table}/{table_id}', 'AuditController@getData');
Route::get('/audit/view/{id}', 'AuditController@viewSingleData');

Route::get('/audit/all', 'AuditController@index');
Route::get('/audit/alldata', 'AuditController@getAll');

Route::get('/audit/report/{exportType}','AuditController@exportData');

Route::get('audit-view/{section}/{table?}', 'AuditController@audit');
Route::get('audit-record/{section}/{table?}', 'AuditController@getAuditData');