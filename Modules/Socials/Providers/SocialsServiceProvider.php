<?php

namespace Modules\Socials\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Modules\Socials\Http\Controllers\Actions\GetSocialsAction;
use Illuminate\Support\Facades\Schema;

class SocialsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Socials', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasSocialsModule', \Modules\Socials\Http\Middleware\HasSocialsModule::class);

        if (Schema::hasTable('socials')) {
            $action = new GetSocialsAction;
            $socials = json_decode(json_encode($action->execute()));
            View::share('socials', $socials);
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
        app()->make('router')->aliasMiddleware('HasSocialsModule', \Modules\Socials\Http\Middleware\HasSocialsModule::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Socials', 'Config/config.php') => config_path('socials.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Socials', 'Config/config.php'),
            'socials'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/socials');

        $sourcePath = module_path('Socials', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/socials';
        }, \Config::get('view.paths')), [$sourcePath]), 'socials');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/socials');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'socials');
        } else {
            $this->loadTranslationsFrom(module_path('Socials', 'Resources/lang'), 'socials');
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
            app(Factory::class)->load(module_path('Socials', 'Database/factories'));
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
