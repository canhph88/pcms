<?php

Route::group(['middleware' => 'web', 'prefix' => 'excel', 'namespace' => 'Modules\Excel\Http\Controllers'], function()
{
    Route::get('/', 'ExcelController@index');
});
