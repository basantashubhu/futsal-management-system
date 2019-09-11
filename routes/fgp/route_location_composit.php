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
 * @Date:   2019-03-27 12:42:06
 * @Last Modified by:   Lekh Raj Rai
 * @Last Modified time: 2019-03-28 18:54:21
 */
Route::get('location/state', 'LocationCompositShowController@state');
Route::get('location/region', 'LocationCompositShowController@region');
Route::get('location/district', 'LocationCompositShowController@district');
Route::get('location/city', 'LocationCompositShowController@city');
Route::get('location/county', 'LocationCompositShowController@county');

//fetch all data list
Route::get('location/all/state', 'LocationCompositShowController@fetchState');
Route::get('location/all/region', 'LocationCompositShowController@fetchRegion');
Route::get('location/all/district', 'LocationCompositShowController@fetchDistrict');
Route::get('location/all/city', 'LocationCompositShowController@fetchCity');
Route::get('location/all/county', 'LocationCompositShowController@fetchCounty');

//lookup
Route::get('location/state/name', 'LocationCompositShowController@getStateList');
Route::get('location/state/name/{query}', 'LocationCompositShowController@getStateList');

Route::get('location/region/name', 'LocationCompositShowController@getRegionList');
Route::get('location/region/name/{query}', 'LocationCompositShowController@getRegionList');

Route::get('location/district/name', 'LocationCompositShowController@getDistrictList');
Route::get('location/district/name/{query}', 'LocationCompositShowController@getDistrictList');

Route::get('location/city/name', 'LocationCompositShowController@getCityList');
Route::get('location/city/name/{query}', 'LocationCompositShowController@getCityList');

Route::get('location/county/name', 'LocationCompositShowController@getCountyList');
Route::get('location/county/name/{query}', 'LocationCompositShowController@getCountyList');
/*---------------------------- Location State --------------------------*/

//State Models
Route::get('location/state/add', 'LocationCompositShowController@stateAdd');
Route::get('location/state/view/{id}', 'LocationCompositShowController@stateView');
Route::get('location/getCounty/{state_id}', 'LocationCompositShowController@getCountyData');

Route::get('location/state/edit/{id}', 'LocationCompositShowController@stateEdit');
Route::get('location/state/delete/{id}', 'LocationCompositShowController@stateDelete');

//State store
Route::post('location/state/store', 'LocationCompositController@stateStore');
Route::post('location/state/update/{state}', 'LocationCompositController@stateStore');
Route::post('location/state/delete/', 'LocationCompositController@deleteState');
Route::post('childupdate/state', 'LocationCompositController@childState');

/*------------------------- Location Region --------------------------*/

//Region Models
Route::get('location/region/add', 'LocationCompositShowController@regionAdd');
Route::get('location/region/edit/{id}', 'LocationCompositShowController@regionEdit');
Route::get('location/region/delete/{id}', 'LocationCompositShowController@regionDelete');

//Region store
Route::post('location/region/store', 'LocationCompositController@regionStore');
Route::post('location/region/update/{region}', 'LocationCompositController@regionStore');
Route::post('location/region/delete/', 'LocationCompositController@deleteRegion');

/*------------------------- Location District --------------------------*/

//District Models
Route::get('location/district/add', 'LocationCompositShowController@districtAdd');
Route::get('location/district/edit/{id}', 'LocationCompositShowController@districtEdit');
Route::get('location/district/delete/{id}', 'LocationCompositShowController@districtDelete');
Route::get('location/getDistrict/{county_id}', 'LocationCompositShowController@getDistrictDatas');

//District store
Route::post('location/district/store', 'LocationCompositController@districtStore');
Route::post('location/district/update/{district}', 'LocationCompositController@districtStore');
Route::post('location/district/delete/', 'LocationCompositController@deleteDistrict');

/*------------------------- Location City --------------------------*/

//City Models
Route::get('location/city/add', 'LocationCompositShowController@cityAdd');
Route::get('location/city/edit/{id}', 'LocationCompositShowController@cityEdit');
Route::get('location/city/delete/{id}', 'LocationCompositShowController@cityDelete');
Route::get('location/getCity/{county_id}', 'LocationCompositShowController@getCityData');
Route::get('location/getCity1/{county_id}', 'LocationCompositShowController@getCityDatas');

//City store
Route::post('location/city/store', 'LocationCompositController@cityStore');
Route::post('location/city/update/{city}', 'LocationCompositController@cityStore');
Route::post('location/city/delete/', 'LocationCompositController@deleteCity');

/*------------------------- Location County --------------------------*/

//County Models
Route::get('location/county/add', 'LocationCompositShowController@countyAdd');
Route::get('location/county/view/{id}', 'LocationCompositShowController@countyView');
Route::get('location/county/edit/{id}', 'LocationCompositShowController@countyEdit');
Route::get('location/county/delete/{id}', 'LocationCompositShowController@countyDelete');

//County store
Route::post('location/county/store', 'LocationCompositController@countyStore');
Route::post('location/county/update/{county}', 'LocationCompositController@countyStore');
Route::post('location/county/delete/', 'LocationCompositController@deleteCounty');
Route::post('childupdate/county', 'LocationCompositController@childCounty');

//get table
Route::get('location/getregion/{state_id}', 'LocationCompositShowController@getRegionData');
Route::get('location/getdistrict/{state_id}', 'LocationCompositShowController@getDistrictData');

Route::get('location/getData', 'LocationCompositShowController@getData');
