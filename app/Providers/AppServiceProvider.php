<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Excel\Entities\BooksExcel;
use Modules\Excel\Entities\UsersExcel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Hashids', function($app) {
           return new \Hashids\Hashids('secret');
        });
        $this->app->bind('BooksExcel', function($app) {
            return new BooksExcel();
        });
        $this->app->bind('UsersExcel', function($app) {
            return new UsersExcel();
        });
    }
}
