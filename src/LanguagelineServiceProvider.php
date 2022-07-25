<?php

namespace Nos\Languageline;

use Illuminate\Support\ServiceProvider;
use Nos\Languageline\Services\LanguageService;

final class LanguagelineServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'nos.languageline');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'nos.languageline');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/languageline.php' => config_path('languageline.php'),
        ], 'languageline.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/codersstudio/languageline')
        ], 'languageline.views');

        // Publishing the js.
        $this->publishes([
            __DIR__ . '/../resources/js' => base_path('resources/js/vendor/codersstudio/languageline'),
        ], 'languageline.js');

        // Publishing the translation files.
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/codersstudio/languageline'),
        ], 'languageline.lang');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/languageline.php', 'languageline');

        $this->app->bind(LanguageService::class);

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
    public function provides(): array
    {
        return ['languageline'];
    }
}
