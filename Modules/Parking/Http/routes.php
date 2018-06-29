<?php

Route::group(['middleware' => 'web', 'prefix' => 'parking', 'namespace' => 'Modules\Parking\Http\Controllers'], function()
{
    Route::get('/', 'ParkingController@index');
    Route::post('/ajaxParkingList', 'ParkingController@ajaxParkingList');
    Route::get('/create/', 'ParkingController@create');
});
