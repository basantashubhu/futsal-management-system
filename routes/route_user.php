<?php


/*-----------------------------------------------------
|                   User Route                         |
-------------------------------------------------------*/
Route::get('/user', 'UserController@index');
Route::get('/user/all', 'UserController@all');
Route::get('/user/userList', 'UserController@userList');

/*-----------------------------------------------------
|                   User Add Route                    |
-------------------------------------------------------*/
Route::get('/user/add', 'UserController@create');
Route::post('/user/add', 'UserController@store');

/*-----------------------------------------------------
|                   User Edit Route                    |
-------------------------------------------------------*/
Route::get('/user/edit/{user}', 'UserController@edit');
Route::post('/user/update/{user}', 'UserController@update');
/*-----------------------------------------------------
|                   User Edit Route                    |
-------------------------------------------------------*/
Route::get('/user/delete/{user}', 'UserController@delete');
Route::post('/user/destroy/{user}', 'UserController@destroy');

/*-----------------------------------------------------
|            User Change password Route            |
-------------------------------------------------------*/
Route::get('/user/changePassword/{user}', 'UserController@changePassword');
Route::post('/user/changePassword/{user}', 'UserController@updatePassword');

Route::get('userProfile/{id?}', 'UserController@userProfile');
Route::get('user-county-list', 'UserController@userCounties');

Route::get('userCheckPass/{user}', 'UserController@checkPass');
Route::post('changePass/{user}', 'UserController@updatePassword');

/*  supervisor control   */
Route::get('supervisors/list', 'UserController@getSupervisors');

/* Email already exits */

Route::get('checkUserEmail', 'UserController@checkUserEmail');
Route::get('checkUserName', 'UserController@checkUserName');

Route::get('user/{user}/sites-list', 'UserController@getSites');
Route::get('users/{user}/volunteers/getData', 'UserController@getVolData');

Route::get('users/transfer/volunteer', 'UserController@transferVolModal');

Route::post('users/{user}/tansfer/volunteers', 'UserController@transferVols');
