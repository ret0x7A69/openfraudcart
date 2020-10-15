<?php

namespace App\Providers;

    use Backend;
    use Illuminate\Support\ServiceProvider;

    class BackendServiceProvider extends ServiceProvider
    {
        public function boot()
        {
            $this->app->booted(function () {
                Backend::loadMenuItems();
            });
        }

        public function register()
        {
        }
    }
