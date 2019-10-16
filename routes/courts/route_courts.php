<?php

Route::get('courts', 'CourtShowController@index');

Route::get('courts/getData', 'CourtDataController@getData');

Route::get('courts/create', 'CourtShowController@create');