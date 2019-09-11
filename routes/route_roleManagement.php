<?php

Route::get('/roleManagement','RoleManagementController@index');

/*--------------------------------------------------------
|               Role Route Here                            |
-----------------------------------------------------------*/
Route::get('/role','RoleManagementController@role');
Route::get('/role/all','RoleController@all');

Route::get('/role/add','RoleController@create');
Route::post('/role/add','RoleController@store');

Route::get('/role/edit/{role}','RoleController@edit');
Route::post('/role/update/{role}','RoleController@update');

Route::get('/role/delete/{role}','RoleController@delete');
Route::post('/role/delete/{role}','RoleController@destroy');


/*--------------------------------------------------------
|               Permission Route Here                    |
-----------------------------------------------------------*/
Route::get('/permission','RoleManagementController@permission');
Route::get('/permission/all','PermissionController@all');
Route::get('/permission/getPermission','PermissionController@getPermission');

Route::get('/permission/add','PermissionController@create');
Route::post('/permission/add','PermissionController@store');

Route::get('/permission/edit/{permission}','PermissionController@edit');
Route::post('/permission/update/{permission}','PermissionController@update');

Route::get('/permission/delete/{permission}','PermissionController@delete');
Route::post('/permission/delete/{permission}','PermissionController@destroy');


/*--------------------------------------------------------
|               Page Route Here                            |
-----------------------------------------------------------*/
Route::get('/pages','RoleManagementController@pages');
Route::get('/pages/all','PageController@all');
Route::get('/pages/getAction/{page}','PageController@getAction');

Route::get('/pages/add','PageController@create');
Route::post('/pages/add','PageController@store');

Route::get('/pages/edit/{page}','PageController@edit');
Route::post('/pages/update/{page}','PageController@update');

Route::get('/pages/delete/{page}','PageController@delete');
Route::post('/pages/delete/{page}','PageController@destroy');


/*--------------------------------------------------------
|               RolePermission Route Here                 |
-----------------------------------------------------------*/
Route::get('/rolePermission','RoleManagementController@rolePermission');
Route::get('/rolePermission/all','RolePermissionController@all');

Route::get('/rolePermission/add','RolePermissionController@create');
Route::post('/rolePermission/add','RolePermissionController@store');

Route::get('/rolePermission/edit/{role}','RolePermissionController@edit');
Route::post('/rolePermission/update/{role}','RolePermissionController@update');

Route::get('/rolePermission/delete/{rolePermission}','PermissionController@delete');
Route::post('/rolePermission/delete/{rolePermission}','PermissionController@destroy');

Route::get('rolePermission/preview/{role}', 'RolePermissionController@preview');


/*--------------------------------------------------------
|               UserPermission Route Here                 |
-----------------------------------------------------------*/
Route::get('/userPermission','RoleManagementController@userPermission');
Route::get('/userPermission/all','UserPermissionController@all');

Route::get('/userPermission/add','UserPermissionController@create');
Route::post('/userPermission/add','UserPermissionController@store');

Route::get('/userPermission/edit/{user}','UserPermissionController@edit');
Route::post('/userPermission/update/{user}','UserPermissionController@update');

Route::get('/userPermission/delete/{userPermission}','PermissionController@delete');
Route::post('/userPermission/delete/{userPermission}','PermissionController@destroy');