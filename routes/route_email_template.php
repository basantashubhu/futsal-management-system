<?php


Route::get('/email_template', 'EmailTemplateController@index');
Route::get('/email_template/all', 'EmailTemplateController@getAll');

// add template
Route::get('/addTemplate', 'EmailTemplateController@create');
Route::post('/template/store', 'EmailTemplateController@store');

//edit Template
Route::get('/email_template/edit/{template}', 'EmailTemplateController@edit');
Route::post('/email_template/update/{template}', 'EmailTemplateController@update');

// Delete Template
Route::get('/email_template/delete/{template}', 'EmailTemplateController@delete');
Route::post('/email_template/delete/{template}', 'EmailTemplateController@destroy');

//single
Route::get('singleTemplate/{id}', 'EmailTemplateController@getTemplate');

//Default Template
Route::get('default_template', 'DefaultTemplateController@index');
Route::get('default_template/{volunteer}','DefaultTemplateController@volunteerTemplate');

Route::get('addDefaultTemplate', 'DefaultTemplateController@create');
Route::post('defaultTemplate/store', 'DefaultTemplateController@store');

//get Template Name
Route::get('getTemplateName/{query?}', 'EmailTemplateController@getTemplateName');

//Default Template
Route::get("default_template/all", "DefaultTemplateController@getAll");
// Delete Template
Route::get('/default_template/delete/{template}', 'DefaultTemplateController@delete');
Route::post('/default_template/delete/{template}', 'DefaultTemplateController@destroy');

//
Route::get('defaultTemplate/singleTemplate/{template}', 'DefaultTemplateController@viewTemplate');