<?php

namespace Modules\Author\Providers;

use Hashids\Hashids;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Author\Entities\Author;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $rootUrlNamespace = 'Modules\Author\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();

//        Route::model('author', Author::class);


    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        // if (!app()->routesAreCached()) {
        //    require __DIR__ . '/Http/routes.php';
        // }
    }
}
