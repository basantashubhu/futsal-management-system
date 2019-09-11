<?php


Route::get('/calendar', function () {
    return view('default.pages.calendar.index');
});

Route::get('templateLoad', 'TemplateShowController@template');
Route::get('loadAllTemplate', 'TemplateShowController@loadAllTemplate');
Route::post('templateSave', 'TemplateShowController@saveTemplate');
Route::get('saveTemplateName/{id}', 'TemplateShowController@saveTemplateName');
Route::post('storeTemplateName/{id}', 'TemplateShowController@storeTemplateName');
Route::post('cancelTemplateName/{id}', 'TemplateShowController@cancelTemplateName');
Route::get('getTemplate/{temp}', 'TemplateShowController@getTemplate');
