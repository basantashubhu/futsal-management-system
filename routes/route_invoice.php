<?php

Route::get('/invoice', 'InvoiceController@index');
Route::get('/invoice/all', 'InvoiceController@getAll');

Route::get('/invoice/getByApplication/{application}', 'InvoiceController@getInvoiceByApplication');
Route::get('/invoice/changeStatus/{invoice}', 'InvoiceController@changeStatusModal');
Route::post('/invoice/status/{invoice}', 'InvoiceController@changeStatus');


Route::get('/application/getInvoice/{application}', 'InvoiceController@view');
Route::get('/application/getInvoiceInv/{invoice}','InvoiceController@viewInv');

Route::get('invoice/getViewPartial/{invoice}','InvoiceController@viewInvPartial');

/*---------------------------------------------------------------------------------------
|                                    Edit Invoice Route                                 |
-----------------------------------------------------------------------------------------*/

Route::get('/invoice/edit/{invoice}','InvoiceController@edit');
Route::post('/invoice/update/{invoice}','InvoiceController@update');

//for dashboard invoice chart
Route::get('invoice/chart', 'InvoiceController@getChartData');

Route::get('/invoice/bulkpayment', 'InvoiceController@bulkPayModal');
//batch payment
Route::get('/invoice/batchpayment', 'InvoiceController@batchPayModal');


Route::get('invoice/report/{type}', 'InvoiceController@export');

//
Route::get('changeInvoiceNumber/{id}', 'InvoiceController@changeInvoiceNumber');

/*------route invoice generation-----------*/
Route::post('/invoice/generateInv/{application}/{pet}','InvoiceController@generateAbandon');

/*----------------Route for invoice refund-----------------*/
Route::get('/invoice/refund/{invoice}','InvoiceController@refundView');
Route::post('/invoice/refund/{invoice}','InvoiceController@refund');

/*----------------Route for invoice refund-----------------*/
Route::get('addMonthlyInvoice', 'InvoiceController@addMonthlyInvoice');
Route::get('providerInvoice/{provider}', 'InvoiceController@providerInvoice');

/*---------------------------------------------------------------------------------------
|                                 Monthly Invoice Route                                 |
-----------------------------------------------------------------------------------------*/
Route::post('/invoice/monthly/store','InvoiceController@storeMonthlyInvoice');
Route::get('getRequiredPet/{cert}', 'InvoiceController@getPetData');
Route::get('searchByCert/{cert}', 'InvoiceController@searchByCert');


/*------------------------------------------------------------------------------------------
|                                 Batch Invoice Route                                      |
-------------------------------------------------------------------------------------------*/

Route::get('/invoice_batch', 'InvoiceBatchController@index');
Route::get('/invoice_batch/all', 'InvoiceBatchController@getAll');
Route::get('/invoice_batch/view/{invoiceBatch}','InvoiceBatchController@invoiceView');
Route::get('/invoice_batch/report/{type}','InvoiceBatchController@export');
Route::get('/makePrintPdf/{invoiceBatch}', 'InvoiceBatchController@pdfFile');
Route::get('/getInvoicePdfFile/{filename}', 'InvoiceBatchController@getPdfFile');
/*------------------------------------------------------------------------------------------
|                                 EDit Invoice Route                                      |
-------------------------------------------------------------------------------------------*/
Route::get('/editBatchInvoice/{invoiceBatch}', 'InvoiceBatchController@editbatch');
Route::post('/updateBatchInvoice/{invoiceBatch}','InvoiceBatchController@updateBatchOld');
Route::post('/updateBatchInv/{invoiceBatch}','InvoiceBatchController@updateBatch');