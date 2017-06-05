<?php

namespace Agphyo\Backend;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ __DIR__.'/assets' => public_path('backend'), ], 'public');
        $this->publishes([
          __DIR__.'/views/backend' => base_path('resources/views/backend'),
          __DIR__.'/views/layouts' => base_path('resources/views/layouts'),
          __DIR__.'/views/auth' => base_path('resources/views/auth'),
          __DIR__.'/migrations' => base_path('database/migrations'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->loadRoutesFrom(__DIR__.'/routes.php');
      $this->app->make('Agphyo\Backend\BackendController');
      $this->app->make('Agphyo\Backend\UserController');
    }
}
