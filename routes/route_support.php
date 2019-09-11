<?php


//View Support
Route::get('support', 'SupportController@index');
Route::any('support/all', 'SupportController@getAll');
//add Support
Route::get('support/add', 'SupportController@addSupport');
Route::post('support/store', 'SupportController@storeSupport');

//view single
Route::get('support/viewSingle/{id}', 'SupportController@viewSingle');

//edit support
Route::get('support/editSupport/{id}', 'SupportController@editSupport');
Route::post('support/update/{id}', 'SupportController@update');

//delete support
Route::get('support/deleteSupport/{id}', 'SupportController@deleteSupport');
Route::post('support/destroySupport/{support}', 'SupportController@destroySupport');

//Comment
Route::post('support/commentStore/{id}', 'SupportCommentController@commentStore');
Route::post('sendSupportUrl/support/commentStore/{id}', 'SupportCommentController@commentStore');
//comment update
Route::post('support/commentUpdate/{id}', 'SupportCommentController@updateComment');
Route::post('sendSupportUrl/support/commentUpdate/{id}', 'SupportCommentController@updateComment');
//comment delete
Route::get('comment/deleteComment/{id}/{comment}', 'SupportCommentController@commentDelete');
Route::get('sendSupportUrl/comment/deleteComment/{id}/{comment}/{from?}', 'SupportCommentController@commentDelete');

Route::post('support/commentDelete/{id}', 'SupportCommentController@deleteComment');
Route::post('sendSupportUrl/support/commentDelete/{id}', 'SupportCommentController@deleteComment');

Route::get('comment/bestanswer/{id}/{comment}', 'SupportCommentController@bestAnswer');
Route::get('sendSupportUrl/comment/bestanswer/{id}/{comment}/{from?}', 'SupportCommentController@bestAnswer');

Route::post('comment/bestanswer/{id}/{comment}', 'SupportCommentController@Solved');
Route::post('support/commentReplay/{support}/{comment}', 'SupportCommentController@commentReplayStore');

//file
Route::get('support/file/{id}', 'SupportController@viewFile');

//support url
Route::get('sendSupportUrl/{id}', 'SupportController@urlView');

//user manual
Route::get('userManual', 'UserManualController@index');
Route::get('userManual/add', 'UserManualController@add');
Route::post('userManual/store', 'UserManualController@store');
Route::get('userManual/viewSingle/{id}', 'UserManualController@viewSingle');
Route::get('userManual/edit/{id}', 'UserManualController@edit');
Route::post('userManual/update/{id}', 'UserManualController@update');
Route::get('userManual/delete/{id}', 'UserManualController@delete');
Route::post('userManual/destroy/{id}', 'UserManualController@destroy');
Route::get('userManual/uploadFile', 'UserManualController@importData');
Route::get('userManual/searchResult/{title}', 'UserManualController@searchResult');

Route::get('userManual/getPDF','UserManualController@createPDF');
