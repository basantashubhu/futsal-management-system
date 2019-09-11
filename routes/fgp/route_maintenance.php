<?php

/*--------------------------------------------------------------------------------------------
|                                                              |
---------------------------------------------------------------------------------------------*/
Route::get('maintenance', 'MaintenanceController@index');
Route::get('getAllTable', 'MaintenanceController@getAllTable');
Route::get('getTableDesc/{table}', 'MaintenanceController@getTableDesc');
Route::get('singleRowDetail/{table}/{id}', 'MaintenanceController@singleRowDetail');
/*--------------------------------------------------------------------------------------------
|                            view, delete and update table  data            |
---------------------------------------------------------------------------------------------*/
Route::get('viewTable/{id}', 'MaintenanceController@viewTable');
Route::post('updateTableData/{table}/{id}', 'MaintenanceController@updateTableData');
Route::get('deleteSelectedData/{table}/{id}', 'MaintenanceController@deleteSelectedData');
Route::post('deleteTableData/{table}/{id}', 'MaintenanceController@deleteTableData');
/*--------------------------------------------------------------------------------------------
|                            Sync table              |
---------------------------------------------------------------------------------------------*/
Route::get('syncTable', 'MaintenanceController@syncTable');

/*--------------------------------------------------------------------------------------------
|                            updating table field label and description              |
---------------------------------------------------------------------------------------------*/
Route::get('editTable/{id}', 'MaintenanceController@editTable');
Route::post('updateTableFields/{id}', 'MaintenanceController@updateTable')
?>