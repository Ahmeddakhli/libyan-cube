<?php

namespace Modules\Meetings\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class MeetingsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Meetings', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasMeetingsModule', \Modules\Meetings\Http\Middleware\HasMeetingsModule::class);
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
            module_path('Meetings', 'Config/config.php') => config_path('meetings.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Meetings', 'Config/config.php'),
            'meetings'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/meetings');

        $sourcePath = module_path('Meetings', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/meetings';
        }, \Config::get('view.paths')), [$sourcePath]), 'meetings');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/meetings');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'meetings');
        } else {
            $this->loadTranslationsFrom(module_path('Meetings', 'Resources/lang'), 'meetings');
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
            app(Factory::class)->load(module_path('Meetings', 'Database/factories'));
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
