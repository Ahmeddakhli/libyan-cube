<?php

namespace Modules\KeyWords\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Modules\KeyWords\Http\Controllers\Actions\GetKeyWordsAction;

class KeyWordsServiceProvider extends ServiceProvider
{
    /**
     * Boot the application key words.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('KeyWords', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasKeyWordsModule', \Modules\KeyWords\Http\Middleware\HasKeyWordsModule::class);
        if (Schema::hasTable('key_words')) {
            $action = new GetKeyWordsAction;
            $key_words = json_decode(json_encode($action->execute()));
            View::share('key_words', $key_words);
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
            module_path('KeyWords', 'Config/config.php') => config_path('key_words.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('KeyWords', 'Config/config.php'),
            'key_words'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/kwy_words');

        $sourcePath = module_path('KeyWords', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/KeyWords';
        }, \Config::get('view.paths')), [$sourcePath]), 'key_words');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/keyWords');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'key_words');
        } else {
            $this->loadTranslationsFrom(module_path('KeyWords', 'Resources/lang'), 'key_words');
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
            app(Factory::class)->load(module_path('KeyWords', 'Database/factories'));
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
