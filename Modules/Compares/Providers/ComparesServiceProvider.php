<?php

namespace Modules\Compares\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;

class ComparesServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Compares', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasComparesModule', \Modules\Compares\Http\Middleware\HasComparesModule::class);
        // if (Schema::hasTable('i_units')) {
        //     $action = new GetComparesAction;
        //     $compares_count = $action->execute()->count();
        //     View::share('compares_count', $compares_count);
        // }
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
            module_path('Compares', 'Config/config.php') => config_path('compares.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Compares', 'Config/config.php'),
            'compares'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/compares');

        $sourcePath = module_path('Compares', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/compares';
        }, \Config::get('view.paths')), [$sourcePath]), 'compares');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/compares');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'compares');
        } else {
            $this->loadTranslationsFrom(module_path('Compares', 'Resources/lang'), 'compares');
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
            app(Factory::class)->load(module_path('Compares', 'Database/factories'));
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
