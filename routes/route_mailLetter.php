<?php

Route::get('/mailletters','MailLetterController@index');
Route::get('/mailletters/all','MailLetterController@getAll');



Route::get('/mailletters/changestatus/{letter}','MailLetterController@changeStatusView');
Route::post('/mailletters/changestatus/{letter}','MailLetterController@changeStatus');