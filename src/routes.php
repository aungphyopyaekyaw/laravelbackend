<?php
Route::group(['middleware' => 'web'], function () {
    Route::get('/backend', 'agphyo\backend\BackendController@index');
    Route::get('/home', 'agphyo\backend\BackendController@index');
    Route::resource('/user', 'agphyo\backend\UserController');
});
