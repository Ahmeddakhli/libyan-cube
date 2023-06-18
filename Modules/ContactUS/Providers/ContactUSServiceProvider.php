<?php

namespace Modules\ContactUS\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ContactUSServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('ContactUS', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasContactUsModule', \Modules\ContactUS\Http\Middleware\HasContactUsModule::class);
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
            module_path('ContactUS', 'Config/config.php') => config_path('contactus.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('ContactUS', 'Config/config.php'),
            'contactus'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/contactus');

        $sourcePath = module_path('ContactUS', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/contactus';
        }, \Config::get('view.paths')), [$sourcePath]), 'contactus');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/contactus');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'contactus');
        } else {
            $this->loadTranslationsFrom(module_path('ContactUS', 'Resources/lang'), 'contactus');
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
            app(Factory::class)->load(module_path('ContactUS', 'Database/factories'));
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
