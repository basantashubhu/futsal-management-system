<?php


Route::get('/application/detail/sandbox','SandBoxController@applicationDetail');
Route::get('/application/detail/sandbox/add_treatment_plan/{petId}','SandBoxController@addTreatmentPlan');
Route::get('/application/detail/sandbox/uploadFile','SandBoxController@uploadFile');

Route::get('/application_np/detail/sandbox','SandBoxController@applicationNPDetail');


/*-------------------------------------------------------------------
|                   Organization Approval                    |
--------------------------------------------------------------------*/
Route::post('nonProfitStatus', 'SandBoxController@nonProfitStatus');

Route::post('nonProfit_appDenial', 'SandBoxController@nonProfit_appDenial');

Route::post('nonProfit_invoice', 'SandBoxController@nonProfitStatus_invoice');

Route::post('nonProfit_payment', 'SandBoxController@nonProfit_payment');

Route::get('addNpSandbox', 'SandBoxController@addNp');


/*-------------------------------------------------------------------
|                   Table Route                                      |
--------------------------------------------------------------------*/
Route::get('tableDemo','SandBoxController@tableDemo');


/*-------------------------------------------------------------------
|                   Table Route                                      |
--------------------------------------------------------------------*/
Route::get('agreementDemo','SandBoxController@agreementDemo');