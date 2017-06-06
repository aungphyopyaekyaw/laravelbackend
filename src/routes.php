<?php
Route::group(['middleware' => 'web'], function () {
    Route::get('/backend', 'agphyo\backend\BackendController@index');
    Route::get('/profile', 'agphyo\backend\BackendController@profile');
    Route::post('/upload', 'agphyo\backend\BackendController@upload');
    Route::patch('/update', 'agphyo\backend\BackendController@update');
    Route::get('/home', function(){
        return redirect('/backend');
    });
    Route::resource('/user', 'agphyo\backend\UserController');
});
