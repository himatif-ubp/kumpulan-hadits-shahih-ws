<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/imam/all', 'ImamCT@all');
Route::post('/kitab/all', 'KitabCT@all');
Route::post('/bab/all', 'BabCT@all');
Route::post('/hadits/all', 'HaditsCT@all');
Route::post('/users/first', 'UsersCT@store');
Route::post('/users/update-token', 'UsersCT@updateToken');
Route::post('/users/last-seen', 'UsersCT@lastSeen');