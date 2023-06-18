<?php

namespace Modules\Settings\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Modules\Settings\Http\Controllers\Actions\Contacts\GetContactsAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\GetFooterLinksAction;
use Modules\Settings\Http\Controllers\Actions\Logos\GetFrontLogosAction;
use Illuminate\Support\Facades\Schema;
use Modules\Settings\Http\Controllers\Actions\Contacts\GetFrontContactsAction;
use Modules\Settings\Setting;

class SettingsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Settings', 'Database/Migrations'));
        app()->make('router')->aliasMiddleware('HasSettingsModule', \Modules\Settings\Http\Middleware\HasSettingsModule::class);

        if (Schema::hasTable('footer_links')) {
            $action = new GetFooterLinksAction;
            $footerlinks = json_decode(json_encode($action->execute()));
            View::share('footerlinks', $footerlinks);
        }

        if (Schema::hasTable('contacts')) {
            $action = new GetFrontContactsAction;
            $contacts = json_decode(json_encode($action->execute()));
            View::share('contacts', $contacts);
        }

        if (Schema::hasTable('logos')) {
            $action = new GetFrontLogosAction;
            $logos = $action->execute();
            View::share('logos', $logos);
        }
        if (Schema::hasTable('settings')) {
            $setting = Setting::where('id',1)->first();
            View::share('setting', $setting);
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
            module_path('Settings', 'Config/config.php') => config_path('settings.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Settings', 'Config/config.php'),
            'settings'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/settings');

        $sourcePath = module_path('Settings', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/settings';
        }, \Config::get('view.paths')), [$sourcePath]), 'settings');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/settings');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'settings');
        } else {
            $this->loadTranslationsFrom(module_path('Settings', 'Resources/lang'), 'settings');
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
            app(Factory::class)->load(module_path('Settings', 'Database/factories'));
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
