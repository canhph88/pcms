<?php

Route::group(['middleware' => 'web', 'prefix' => 'author', 'namespace' => 'Modules\Author\Http\Controllers'], function()
{
    Route::bind('author', function ($value) {

        $hashids = new \Hashids\Hashids('secret');

        $id = $hashids->decode($value)[0];

//            abort(404);

        return \Modules\Author\Entities\Author::findOrFail($id);
    });

    Route::get('/', ['middleware' => ['permission:author-index'], 'uses' => 'AuthorController@index']);
    Route::get('/index', ['middleware' => ['permission:author-index'], 'uses' => 'AuthorController@index']);
    Route::get('/search', ['middleware' => ['permission:author-index'], 'uses' => 'AuthorController@search']);
    Route::get('/show/{author}', ['middleware' => ['permission:author-show'], 'uses' => 'AuthorController@show']);
    Route::get('/create', ['middleware' => ['permission:author-create'], 'uses' => 'AuthorController@create']);
    Route::post('/store', ['middleware' => ['permission:author-create'], 'uses' => 'AuthorController@store']);
    Route::get('/edit/{author}', ['middleware' => ['permission:author-edit'], 'uses' => 'AuthorController@edit']);
    Route::post('/update', ['middleware' => ['permission:author-edit'], 'uses' => 'AuthorController@update']);
    Route::get('/delete/{author}', ['middleware' => ['permission:author-delete'], 'uses' => 'AuthorController@destroy']);
    Route::post('/deleteMultiple', ['middleware' => ['permission:author-delete'], 'uses' => 'AuthorController@destroyMultiple']);
});
