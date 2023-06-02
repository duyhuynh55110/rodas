<?php

namespace Base\Assets;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * The Laravel service provider, which registers, configures and bootstraps the package.
 */
class ServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * Get the services provided for deferred loading.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            AssetsManager::class,
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        // Load the default config values
        $this->mergeConfigFrom(__DIR__.'/../config/assets.php', 'assets');

        // Register Manager class singleton with the app container
        $this->app->singleton(AssetsManager::class, config('assets.assets_manager'));
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        // Register 'Assets::' view namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'Assets');

        // Publish the config/assets.php file
        // - php artisan vendor:publish --tag=assets-config
        $this->publishes(
            [
                __DIR__.'/../config/assets.php' => config_path('assets.php'),
            ],
            'assets-config'
        );
    }
}
