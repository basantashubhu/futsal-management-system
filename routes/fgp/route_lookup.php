<?php


Route::get('lookup/search-code', 'LookupShowController@getData');

Route::get('lookup/time-sheet/{item}', 'LookupShowController@searchItem');

// add section on fly
Route::get('lookup/section/add', 'LookupShowController@addSectionFly');
Route::post('lookup/section/save', 'LookupAddUpdateController@saveSection');

/* Stipend items route */

Route::get('lookup/generatedPeriodLists', 'LookupShowController@getGeneratedPeriods');

Route::get('lookup/ts/stipend_category', 'LookupShowController@getStipendCategory');
Route::get('lookup/ts/time_type', 'LookupShowController@getStipendTimeType');
Route::get('lookup/ts/stipend_type', 'LookupShowController@getStipendType');
Route::get('lookup/ts/stipend_items', 'LookupShowController@getStipendItem');
Route::get('lookup/ts/fetchStipendDetails/{stipendItem}', 'LookupShowController@getStipendItemDetails');

/* USER */
Route::get('lookup/user/roles', 'LookupShowController@fetchRoles');


/* ts Sites, volunteers */

Route::get('lookup/ts/assignedSites', 'LookupShowController@getAssignedSites');
Route::get('lookup/ts/selectiveSites/{data?}', 'LookupShowController@getSelectiveSites');
Route::get('lookup/ts/assignedVols', 'LookupShowController@getAssignedVolunteers');

/* Vol */

Route::get('fetch/phoneTypes', 'LookupShowController@getPhoneTypes');
Route::get('fetchVolunteerIdType', 'LookupShowController@fetchVolunteerIdType');
Route::get('fetchVolunteerPaymentCode', 'LookupShowController@fetchVolunteerPaymentCode');


Route::get('fetchVolunteerCurrentStatus', 'LookupShowController@getVolCurrentStatus');
Route::get('fetchVolunteerDeactivationReason', 'LookupShowController@getVolDeactivationReason');


// Template

Route::get('/fetch/templateCategories/{volunteerID}', 'LookupShowController@getTemplateCategories');
Route::get('fetchAlltemplateCategories', 'LookupShowController@getAllTemplateCategories');