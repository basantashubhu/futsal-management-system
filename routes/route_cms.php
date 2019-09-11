<?php


//Page
Route::get('page', 'PageController@index');

//post
Route::get('post', 'PostController@index');

//media
Route::get('media', 'MediaController@index');

//component
Route::get('component', 'ComponentController@index');