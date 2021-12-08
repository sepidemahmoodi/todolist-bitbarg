<?php

namespace Modules;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Lang;

class ModuleServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (glob(__DIR__ . '/*/Routes/api/*.php') as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
        foreach (glob(__DIR__ . '/*/migrations/*.php') as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
        foreach (glob(__DIR__ . '/*/Observers/*.php') as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
