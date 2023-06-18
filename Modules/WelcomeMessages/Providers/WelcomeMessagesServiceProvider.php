<?php

namespace Modules\WelcomeMessages\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Modules\WelcomeMessages\Http\Controllers\Actions\GetWelcomeMessagesAction;
use Illuminate\Support\Facades\Schema;

class WelcomeMessagesServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('WelcomeMessages', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasWelcomeMessagesModule', \Modules\WelcomeMessages\Http\Middleware\HasWelcomeMessagesModule::class);

        if (Schema::hasTable('welcome_messages')) {
            $action = new GetWelcomeMessagesAction;
            $welcome_messages = json_decode(json_encode($action->execute()));
            View::share('welcome_messages', $welcome_messages);
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
            module_path('WelcomeMessages', 'Config/config.php') => config_path('welcome_messages.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('WelcomeMessages', 'Config/config.php'), 'welcome_messages'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/welcome_messages');

        $sourcePath = module_path('WelcomeMessages', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/welcomemessages';
        }, \Config::get('view.paths')), [$sourcePath]), 'welcome_messages');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/welcomemessages');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'welcome_messages');
        } else {
            $this->loadTranslationsFrom(module_path('WelcomeMessages', 'Resources/lang'), 'welcome_messages');
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
            app(Factory::class)->load(module_path('WelcomeMessages', 'Database/factories'));
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
