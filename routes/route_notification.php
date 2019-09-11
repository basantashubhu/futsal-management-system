<?php


Route::get('/notifications', 'NotificationController@index');
Route::get('/notifications/all', 'NotificationController@getAll');
Route::get('/notifications/{notification}/markAsRead', 'NotificationController@markAsRead');

Route::get('notifications/markAsRead/pay_periods/{table_id}', 'NotificationController@bulkRead');

Route::get('notifications/markAsRead/all', 'NotificationController@markAllAsRead');

Route::get('notifications/preview/{notification}', 'NotificationController@preview');
