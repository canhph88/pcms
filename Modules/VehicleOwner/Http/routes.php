<?php

Route::group(['middleware' => 'web', 'prefix' => 'vehicleowner', 'namespace' => 'Modules\VehicleOwner\Http\Controllers'], function()
{
    Route::get('/', 'VehicleOwnerController@index');
});
