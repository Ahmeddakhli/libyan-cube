<?php

namespace Modules\Events\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class EventsServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Events', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasEventsModule', \Modules\Events\Http\Middleware\HasEventsModule::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Events', 'Config/config.php') => config_path('events.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Events', 'Config/config.php'),
            'events'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/events');

        $sourcePath = module_path('Events', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/events';
        }, \Config::get('view.paths')), [$sourcePath]), 'events');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/events');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'events');
        } else {
            $this->loadTranslationsFrom(module_path('Events', 'Resources/lang'), 'events');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Events', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
