<?php

namespace CodersStudio\Languageline;

use Illuminate\Support\ServiceProvider;

class LanguagelineServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'codersstudio.languageline');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'codersstudio.languageline');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/languageline.php', 'languageline');

        // Register the service the package provides.
        $this->app->singleton('languageline', function ($app) {
            return new Languageline;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['languageline'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/languageline.php' => config_path('languageline.php'),
        ], 'languageline.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/codersstudio/languageline')
        ], 'languageline.views');

        // Publishing the js.
        $this->publishes([
            __DIR__.'/../resources/js' => base_path('resources/js/vendor/codersstudio/languageline'),
        ], 'languageline.js');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/codersstudio'),
        ], 'logger.views');*/

        // Publishing the translation files.
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/codersstudio/languageline'),
        ], 'languageline.lang');

        // Registering package commands.
        // $this->commands([]);
    }
}
