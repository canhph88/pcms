<?php

Route::group(['middleware' => 'web', 'prefix' => 'vehicle', 'namespace' => 'Modules\Vehicle\Http\Controllers'], function()
{
    Route::get('/', 'VehicleController@index');
});
