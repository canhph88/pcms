<?php

Route::group(['middleware' => 'web', 'prefix' => 'sms', 'namespace' => 'Modules\SMS\Http\Controllers'], function()
{
    Route::get('/', 'SMSController@index');
    Route::post('/ajaxList', 'SMSController@smsAjaxList')->name('smsAjaxList');
    Route::get('/{id}/show', 'SMSController@show');
    Route::get('/send', 'SMSController@showSend');
    Route::post('/send', 'SMSController@send');
});
