<?php

/*--------------------------------------------------------------------------------------------
|                                                              |
---------------------------------------------------------------------------------------------*/

/* Calendar side bar */

Route::get('calendarSchedules', 'CalendarShowController');

Route::get('calendarSchedule/getCalendarData', 'CalendarShowController@getData');
