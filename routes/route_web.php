<?php

/**
 * ------------------------------
 *     Front End Routes
 * ------------------------------
 */

    $web = 'Web\WebController@';

    Route::get('/',  'WebController@index');
    Route::get('/home', 'WebController@home');
    Route::get('/about', 'WebController@about');
    Route::get('/partners',  'WebController@partners');


Route::get('/application', 'WebApplicationController@index');
Route::post('/application', 'WebApplicationController@store');


Route::get('/partners/{zip}', 'WebController@getPatners');