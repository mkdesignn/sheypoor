<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.*'], function($view){

            $roles = Auth::user()->roles->pluck("id", "name");
            $view->with(compact("roles"));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if( class_exists('Laracasts\Generators\GeneratorsServiceProvider') )
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');

        if( class_exists('DaveJamesMiller\Breadcrumbs\ServiceProvider') )
            $this->app->register('DaveJamesMiller\Breadcrumbs\ServiceProvider');

        if( class_exists('Collective\Html\HtmlServiceProvider') )
            $this->app->register('Collective\Html\HtmlServiceProvider');

        if( class_exists('Collective\Html\HtmlServiceProvider') )
            $this->app->register('Collective\Html\HtmlServiceProvider');
    }
}
