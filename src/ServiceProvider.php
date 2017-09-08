<?php

namespace Seekerliu\YaJson;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        // Config path.
        $configPath = realpath(__DIR__.'/config.php');

        // Publish config.
        $this->publishes(
            [$configPath => config_path('yajson.php')],
            'yajson'
        );
    }

    /**
     * Register the provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(YaJson::class, function ($app) {
            return new YaJson($app['config']['yajson']);
        });

        $this->app->alias(YaJson::class, 'YaJson');

        $this->mergeConfigFrom(
            realpath(__DIR__.'/config.php'), 'yajson'
        );
    }
}
