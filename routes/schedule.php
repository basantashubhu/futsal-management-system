<?php
// schedules
Route::get('schedules', 'ScheduleShowController@index');
Route::get('schedules/getData', 'ScheduleDataController@getData');

// add create schedules
Route::get('schedules/add', 'ScheduleShowController@add');
Route::get('schedules/create', 'ScheduleShowController@create');
