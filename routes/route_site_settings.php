<?php



Route::get('/site_settings', 'SiteSettingController@index');
Route::get('/site_settings/all', 'SiteSettingController@getAll');

/*******----------site_settings Add-------******/
Route::get('/addSiteSettings', 'SiteSettingController@create');
Route::post('/site_settings/add', 'SiteSettingController@store');

/*******----------site_settings Edit-------******/
Route::get('/site_settings/edit/{setting}', 'SiteSettingController@edit');
Route::post('/site_settings/update/{setting}', 'SiteSettingController@update');

/*******----------site_settings Delete-------******/
Route::get('/site_settings/delete/{setting}', 'SiteSettingController@delete');
Route::post('/site_settings/destroy/{setting}', 'SiteSettingController@destroy');

/*----------------site_settings Change ---------*******/
Route::get('/sitesetting/change/email', 'SiteSettingController@emailMode');
Route::get('/sitesetting/change/{code}', 'SiteSettingController@applicationMode');
Route::get('/sitesetting/notification/{code}', 'SiteSettingController@notificationChange');


Route::get('/sitesetting/mailchange/{code}', 'SiteSettingController@mailConfig');

/*----------------site_settings Change ---------*******/
Route::get('site-settings-export/{type}', 'SiteSettingController@exportData');
