<?php


/**
 * -------------------
 * Layout Builder
 * -------------------
 */
Route::get('layout_builder','LayoutController@index');
Route::post('layout_builder/update/{user_id}','LayoutController@update')->name('updateLayoutBuilder');
Route::get('layout_builder/resetConfirm','LayoutController@resetConfirm');
Route::get('layout_builder/reset','LayoutController@resetToDefault')->name('resetLayoutBuilder');
