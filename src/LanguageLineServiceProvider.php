<?php

namespace Nos\LanguageLine;

use Illuminate\Support\ServiceProvider;
use Nos\LanguageLine\Interfaces\Repositories\LanguageLineRepositoryInterface;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;
use Nos\LanguageLine\Repositories\LanguageLineRepository;
use Nos\LanguageLine\Repositories\LanguageRepository;
use Nos\Languageline\Services\LanguageService;

final class LanguageLineServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(resource_path('lang/vendor/nos/languageline'), 'nos.languageline');
        $this->loadViewsFrom(resource_path('views/vendor/nos/languageline'), 'nos.languageline');
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
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/nos/languageline')
        ], 'languageline.views');

        // Publishing the js.
        $this->publishes([
            __DIR__ . '/../resources/js' => base_path('resources/js/vendor/nos/languageline'),
        ], 'languageline.js');

        // Publishing the translation files.
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/nos/languageline'),
        ], 'languageline.lang');

        // Publishing migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => base_path('database/migrations'),
        ], 'languageline.migrations');
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
        $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
        $this->app->bind(LanguageLineRepositoryInterface::class, LanguageLineRepository::class);

        // Register the service the package provides.
        $this->app->singleton('languageline', function ($app) {
            return new Languageline();
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
