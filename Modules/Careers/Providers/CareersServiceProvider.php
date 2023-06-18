<?php

namespace Modules\Careers\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CareersServiceProvider extends ServiceProvider
{
    /**
     * Boot the application careers.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Careers', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasCareersModule', \Modules\Careers\Http\Middleware\HasCareersModule::class);
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
            module_path('Careers', 'Config/config.php') => config_path('careers.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Careers', 'Config/config.php'), 'careers'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/careers');

        $sourcePath = module_path('Careers', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/careers';
        }, \Config::get('view.paths')), [$sourcePath]), 'careers');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/careers');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'careers');
        } else {
            $this->loadTranslationsFrom(module_path('Careers', 'Resources/lang'), 'careers');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Careers', 'Database/factories'));
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
