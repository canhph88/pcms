<?php

Route::group(['middleware' => 'web', 'prefix' => 'book', 'namespace' => 'Modules\Book\Http\Controllers'], function()
{
    Route::bind('book', function ($value) {

        $hashids = new \Hashids\Hashids('secret');

        $id = $hashids->decode($value)[0];
        return \Modules\Book\Entities\Book::findOrFail($id);

    });

    Route::get('/', ['middleware' => ['permission:book-index'], 'uses' => 'BookController@index'])->name('index books');
    Route::get('/index', ['middleware' => ['permission:book-index'], 'uses' => 'BookController@index'])->name('index books');
    Route::get('/search', ['middleware' => ['permission:book-index'], 'uses' => 'BookController@search']);
    Route::get('/show/{book}', ['middleware' => ['permission:book-show'], 'uses' => 'BookController@show']);
    Route::get('/create', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@create']);
    Route::post('/store', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@store']);
    Route::get('/edit/{book}', ['middleware' => ['permission:book-edit'], 'uses' => 'BookController@edit']);
    Route::post('/update', ['middleware' => ['permission:book-edit'], 'uses' => 'BookController@update']);
    Route::get('/delete/{book}', ['middleware' => ['permission:book-delete'], 'uses' => 'BookController@destroy']);
    Route::post('/deleteMultiple', ['middleware' => ['permission:book-delete'], 'uses' => 'BookController@destroyMultiple']);
    Route::get('/download', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@showDownload']);
    Route::get('/download/{file}', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@download']);
    Route::get('/export', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@export']);
    Route::post('/import', ['middleware' => ['permission:book-create'], 'uses' => 'BookController@import']);
});
