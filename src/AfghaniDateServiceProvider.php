<?php
namespace EmalHamza\AfghaniDate;

use Illuminate\Support\ServiceProvider;

class AfghaniDateServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Bind your class(es) into the Laravel container
        $this->app->singleton(AfghaniDate::class, function ($app) {
            return new AfghaniDate();
        });

        // Optionally, you can register a custom helper function
        // if you want to provide simple global functions.
        // require_once __DIR__ . '/helpers.php';
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Load configuration, views, routes, migrations, etc. (if any)
        // For example, you can publish config files:
        // $this->publishes([
        //     __DIR__ . '/config/afghani-date.php' => config_path('afghani-date.php'),
        // ]);
    }
}
