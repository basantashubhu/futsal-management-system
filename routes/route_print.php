<?php


//Route::get('/print/application/{id}','PrintController@printApp');
Route::get('/print/{model}/{id}','PrintController@performPrint');
//Route::get('/print/organization/{id}','PrintController@printOrg');