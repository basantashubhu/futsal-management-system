<?php


Route::get('/report/incomeEligible','IEReportController@index');
Route::get('/ieReport/getByclient/{client}','IEReportController@getApplicationByClient');
/*--------------Advance Search-----------------------------*/
Route::get('/report/incomeEligible/advSearch','ReportController@advSearch');
Route::get('/report/incomeEligible/getAll','ReportController@getReport');

/*----------Route For chart data------------*/
Route::get('/report/incomeEligible/getPetData','ReportController@getPetReport');
Route::get('/report/incomeEligible/getClientData','ReportController@getClientReport');

/*-----------Route for provider Report----------*/
Route::get('/report/provider','ProviderReportController@index')->middleware('canAccess:reports,view');
Route::get('/report/allProvider','ProviderReportController@getAll');


/*--------------Route For Pet wise Report---------------*/
Route::get('/reports/pet','PetReportController@index')->middleware('canAccess:reports,view');
Route::get('/reports/pet/getTotalChart','PetReportController@totalSurgeryChartData');
Route::get('/reports/pet/getIEChart','PetReportController@ieSurgeryChartData');
Route::get('/reports/pet/getNPChart','PetReportController@npSurgeryChartData');

/*------------------Report For Treatment----------------*/
Route::get('/report/treatment','TreatmentReportController@index')->middleware('canAccess:reports,view');
Route::get('/report/treatment/getRabiesChart','TreatmentReportController@getRabiesChart');
Route::get('/report/treatment/getSurgeryChart','TreatmentReportController@getSurgeryChart');


/*-----------------Route For main Report-----------------*/
Route::get('/reports','MasterReportController@index')->middleware('canAccess:reports,view');
Route::get('/reports/loadSection/{section}','MasterReportController@loadRightSection');
Route::get('/report/download/{report}','MasterReportController@downloadFile');

/*-----------------Route For Modal search-------------------*/
Route::get('/report/search/statement','MasterReportController@statementModal');
Route::get('/report/search/provider','MasterReportController@providerModal');
Route::get('/report/search/pet','MasterReportController@petModal');
Route::get('/report/search/citizen','MasterReportController@citizenModal');
Route::get('/report/search/nonExpiredApplication','MasterReportController@nonExpiredApplicationModal');
Route::get('/report/search/sql','MasterReportController@sqlModal');

/*---------------------Route from Report Generation and retrive-------------------------------------*/

Route::get('/report/getReportLog/{section}','ReportController@getReportLog');
Route::post('/generate/statementReport/{format}','ReportController@generateStatement');
Route::post('/generate/providerReport/{format}','ReportController@generateProvider');
Route::post('/generate/petReport/{format}','ReportController@generatePet');
Route::post('/generate/citizenReport/{format}','ReportController@generateCitizen');
Route::post('/generate/nonExpireApplicationReport/{format}','ReportController@generatenonExpireApplicationReport');
Route::post('/generate/rawQueryReport/{format}','ReportController@generateReportQuery');

/*---------------------Route for report Template-----------------*/

Route::get('/reports/template/view','ReportTemplateController@view');
Route::post('/reports/template/save','ReportTemplateController@store');
Route::get('/reports/template/loadView','ReportTemplateController@loadView');
Route::get('/reports/template/load','ReportTemplateController@load');


/*-------------------For oll single export------------------*/
Route::get('/report/exportAll/{target}/{format}','ReportController@exportReport');

/*---------------generateMailReport ---------------*/
Route::get('/report/loadMailSection', 'MasterReportController@loadMailSection');
Route::post('generateMailList', 'MasterReportController@generateMailList');
Route::get('/report/getPostMail','ReportController@getPostMail');

Route::get('viewOriginalFile/{id}', 'MasterReportController@viewFile');
Route::get('report/viewFile/{type}/{id}', 'MasterReportController@viewPdfFile');
Route::get('undoReport/{id}', 'MasterReportController@undoReport');
Route::get('getGenerateForm', 'MasterReportController@getForm');
Route::get('reportSentForm/{id}', 'MasterReportController@reportSentForm');
Route::post('reportMailSent/{id}', 'MasterReportController@reportMailSent');
Route::post('updateMailSent/{id}', 'MasterReportController@updateMailSent');

Route::get('/report/getFile/{fileName}','MasterReportController@getPostFile');

//Post Mail
Route::get('postMail', 'PostMailController@index');
Route::get('updateApplicationTable', 'PostMailController@updateTable');
Route::get('countMailFileMerge', 'PostMailController@countMail');
Route::get('getGenerateLists', 'PostMailController@getGenerateLists');
Route::get('getAllLists', 'PostMailController@getAllLists');