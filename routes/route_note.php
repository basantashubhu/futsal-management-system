<?php



Route::get('/event/all', 'NoteController@AllEvents');
Route::post('/event', 'NoteController@store');
Route::get('/editEvent/{id}', 'NoteController@editEvent');
Route::post('/updateEvent/{id}', 'NoteController@updateEvent');



Route::get('/note', 'NoteController@index');
Route::get('/note/todo', 'NoteController@todo');
Route::get('/notes/create/{application}', 'NoteController@create');
Route::post('/notes/store/{id}', 'NoteController@storeNote');
Route::get('/notes/application/{id}', 'NoteController@getApplicationNotes');
Route::get('/notes/orgAll/{id}/{status}', 'NoteController@getOrganizationNotes');

Route::get('/note/all/{id}', 'NoteController@getAllNotes');
Route::get('/addNote', 'NoteController@createNote');
Route::get('/addNote/{volId}', 'NoteController@createNote');
Route::post('/note/noteStore', 'NoteController@noteStore');

Route::get('note/view/{note}', 'NoteController@viewSingle');
Route::get('note/edit/{note}', 'NoteController@editNote');
Route::post('note/noteUpdate/{note}', 'NoteController@noteUpdate');

Route::get('/note/delete/{note}', 'NoteController@delete');
Route::post('/note/delete/{note}', 'NoteController@destory');

//All note
Route::get('/note/getAll', 'NoteController@getAll');
Route::get('/note/allFromDasboard', 'NoteController@getAllForDashboard');


Route::post('/note/todo/create', 'NoteController@CreateTodo');

Route::post('/todo/completed', 'NoteController@markAsCompleted');
Route::post('/todo/completed/{id}', 'NoteController@markComplete');

//note done
Route::get('noteDone/{note}', 'NoteController@noteDone');

/*select note volunteer modal*/
Route::get('note/selectVolunteer', 'NoteController@volunteer_modal');
Route::get('note/selectedVolunteer/{volunteer}', 'NoteController@selectVolunteerSite');

/*select note site modal*/
Route::get('note/selectSite', 'NoteController@site_modal');
Route::get('note/selectedSite/{site}', 'NoteController@selectNoteSite');

/*retrive datas for note add modal*/
Route::get('volunteer/all', 'NoteController@allVolunteers');
Route::get('sites/fetchAll', 'NoteController@allSites');


Route::prefix('notes')->group(function() {
    Route::get('todo/today', 'NoteController@todos');
    Route::get('reminders/today', 'NoteController@reminders');
    Route::get('download/{file}', 'NoteController@download');

    Route::get('export/{format}', 'NoteController@export');
});