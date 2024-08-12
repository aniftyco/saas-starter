<?php

namespace NiftyCo\Support\Session;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Session;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Session::extend('database', function (Application $app) {
            $table = $app['config']->get('session.table');
            $lifetime = $app['config']->get('session.lifetime');
            $connection = $app['db']->connection($app['config']->get('session.connection'));

            return new DatabaseSessionHandler($connection, $table, $lifetime, $app);
        });
    }
}
