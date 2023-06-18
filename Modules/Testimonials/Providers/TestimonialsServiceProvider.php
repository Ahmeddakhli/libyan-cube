<?php

namespace Modules\Testimonials\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TestimonialsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Testimonials', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasTestimonialsModule', \Modules\Testimonials\Http\Middleware\HasTestimonialsModule::class);

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
            module_path('Testimonials', 'Config/config.php') => config_path('testimonials.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Testimonials', 'Config/config.php'), 'testimonials'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/testimonials');

        $sourcePath = module_path('Testimonials', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/testimonials';
        }, \Config::get('view.paths')), [$sourcePath]), 'testimonials');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/testimonials');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'testimonials');
        } else {
            $this->loadTranslationsFrom(module_path('Testimonials', 'Resources/lang'), 'testimonials');
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
            app(Factory::class)->load(module_path('Testimonials', 'Database/factories'));
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
