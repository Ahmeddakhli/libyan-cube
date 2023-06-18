<?php

namespace Modules\Messages\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class MessagesServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Messages', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasMessagesModule', \Modules\Messages\Http\Middleware\HasMessagesModule::class);
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
            module_path('Messages', 'Config/config.php') => config_path('messages.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Messages', 'Config/config.php'),
            'messages'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/messages');

        $sourcePath = module_path('Messages', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/messages';
        }, \Config::get('view.paths')), [$sourcePath]), 'messages');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/messages');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'messages');
        } else {
            $this->loadTranslationsFrom(module_path('Messages', 'Resources/lang'), 'messages');
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
            app(Factory::class)->load(module_path('Messages', 'Database/factories'));
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
