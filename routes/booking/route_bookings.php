<?php

Route::get('bookings', 'BookingShowController@index');

// new bookings
Route::get('bookings/new', 'BookingShowController@bookNew');
