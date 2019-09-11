<?php


Route::get('sendEmailGlobal', 'GlobalEmailSendController@getForm');
Route::get('email/send/{to}/{appid}', 'GlobalEmailSendController@index');
Route::get('showExportData', 'GlobalEmailSendController@showExportData');
Route::post('sendEmail', 'GlobalEmailSendController@sendEmail');
//export data
Route::get('sendExport/{table}', 'GlobalEmailSendController@exportData');
//view file
Route::get('viewFile', 'GlobalEmailSendController@viewFile');
//Load Save Email Template
Route::get('loadSaveEmail', 'GlobalEmailSendController@loadSaveEmail');
Route::get('loadSaveEmailAll', 'GlobalEmailSendController@loadSaveEmailAll');
//Save Email Template
Route::post('saveAsDraft', 'GlobalEmailSendController@saveAsDraft');
Route::post('saveEmailTemplate', 'GlobalEmailSendController@saveEmailTemplate');
Route::get('saveTemplate/{id}', 'GlobalEmailSendController@saveTemplate');
Route::post('deleteSetEmail/{id}', 'GlobalEmailSendController@deleteEmail');
Route::post('save/{id}', 'GlobalEmailSendController@save');
Route::get('selectTemplate/{id}', 'GlobalEmailSendController@select');
//Email Section
Route::get('emailSection', 'GlobalEmailSendController@emailSection');
Route::get('/email/select/{status}', 'GlobalEmailSendController@getEmailAll');
Route::get('/email/sentMail', 'GlobalEmailSendController@sentMail');
Route::get('/email/draftMail', 'GlobalEmailSendController@draftMail');
Route::get('emailCompose', 'GlobalEmailSendController@composeMail');
Route::get('emailSingle/{id}', 'GlobalEmailSendController@viewSingle');