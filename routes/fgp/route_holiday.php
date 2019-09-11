<?php

/**
 * @Author: 
 /** 
 * DEVELOPERS 
 * ------------------------------------------------  
 * - SUMAN THAPA - LEAD(NEPALNME@GMAIL.COM) 
 * ------------------------------------------------  
 * - PRABHAT GURUNG 
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA 
 * - MANISH BUDDHACHARYA 
 * - LEKH RAJ RAJ 
 * - ASCOL PARAJULI 
 * ------------------------------------------------  
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019 
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
 * @Date:   2019-03-14 14:29:37
 * @Last Modified by:   Lekh Raj Rai
 * @Last Modified time: 2019-03-14 14:47:11
 */

/*holiday index and holiday data fetch*/
Route::get('/holiday','HolidayShowController@index');
Route::get('/holidays/all','HolidayShowController@allHolidays');

/*Holiday add and update*/
Route::get('/addHoliday','HolidayShowController@addHoliday');
Route::POST('/holiday/store','HolidayStoreController@storeHoliday');

/*Holiday edit and update*/
Route::get('/holiday/edit/{holiday}','HolidayShowController@editHoliday');
Route::POST('/holiday/update/{holiday}','HolidayUpdateController@updateHoliday');

/*holiday delete*/
Route::get('/holiday/delete/modal/{holiday}','HolidayShowController@deleteHoliday');
Route::POST('/holiday/delete/{holiday}','HolidayUpdateController@deleteHoliday');

/*Holiday calendar data*/
Route::get('/holiday/getHolidayCalendarData','HolidayShowController@getCalendarData');

/**/
Route::get('/getHolidayDayDetail/{holiday}','HolidayShowController@detailHolidayView');

//holida export data
Route::get('holiday/report/{type}', 'HolidayShowController@exportData');


/*temporary*/
Route::get('time-sheets/assign/new', 'HolidayShowController@assignTimeSheet');
Route::get('time-sheets/period/{id}', 'HolidayShowController@findPeriod');
Route::get('time-sheets/templates/{sup_id}', 'HolidayShowController@timesheetTemplate');

//get holiday cal_type lookup

Route::get('holiday/cal_type/{term?}','HolidayShowController@getCalType');
Route::get('holiday_type_add','HolidayShowController@newHolidayType');
