<?php

namespace Modules\SEO\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Modules\SEO\Http\Controllers\Actions\GetSeoAction;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Boot the application seo.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Seo', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasSeoModule', \Modules\SEO\Http\Middleware\HasSeoModule::class);
        
        if (Schema::hasTable('seo')) {
            $action = new GetSeoAction;
            $seo = json_decode(json_encode($action->execute()));
            View::share('seo', $seo);
        }
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
            module_path('SEO', 'Config/config.php') => config_path('seo.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('SEO', 'Config/config.php'), 'seo'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/seo');

        $sourcePath = module_path('SEO', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/seo';
        }, \Config::get('view.paths')), [$sourcePath]), 'seo');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/seo');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'seo');
        } else {
            $this->loadTranslationsFrom(module_path('SEO', 'Resources/lang'), 'seo');
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
            app(Factory::class)->load(module_path('SEO', 'Database/factories'));
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
