<?php

Route::group(['middleware' => 'web', 'prefix' => 'genre', 'namespace' => 'Modules\Genre\Http\Controllers'], function()
{
    Route::bind('genre', function ($value)  {

        $hashids = new \Hashids\Hashids('secret');

        try {
            $id = $hashids->decode($value)[0];
            return \Modules\Genre\Entities\Genre::findOrFail($id);
        } catch (Exception $exception) {
            throw new \App\Exceptions\CustomException();
        }

    });

    Route::get('/', ['middleware' => ['permission:genre-index'], 'uses' => 'GenreController@index']);
    Route::get('/index', ['middleware' => ['permission:genre-index'], 'uses' => 'GenreController@index']);
    Route::get('/search', ['middleware' => ['permission:genre-index'], 'uses' => 'GenreController@search']);
    Route::get('/show/{genre}', ['middleware' => ['permission:genre-show'], 'uses' => 'GenreController@show']);
    Route::get('/create', ['middleware' => ['permission:genre-create'], 'uses' => 'GenreController@create']);
    Route::post('/store', ['middleware' => ['permission:genre-create'], 'uses' => 'GenreController@store']);
    Route::get('/edit/{genre}', ['middleware' => ['permission:genre-edit'], 'uses' => 'GenreController@edit']);
    Route::post('/update', ['middleware' => ['permission:genre-edit'], 'uses' => 'GenreController@update']);
    Route::get('/delete/{genre}', ['middleware' => ['permission:genre-delete'], 'uses' => 'GenreController@destroy']);
    Route::post('/deleteMultiple', ['middleware' => ['permission:genre-delete'], 'uses' => 'GenreController@destroyMultiple']);
});
