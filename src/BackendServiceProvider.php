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
        $this->publishes([ __DIR__.'/views/backend' => base_path('resources/views/backend'), ]);
        $this->publishes([ __DIR__.'/views/layouts' => base_path('resources/views/layouts'), ]);
        $this->publishes([ __DIR__.'/views/auth' => base_path('resources/views/auth'), ]);
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
    }
}
