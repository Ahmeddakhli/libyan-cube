<?php

namespace Modules\Inventory\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\View;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetFooterProjectsAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetFooterIUnitsAction;
use Illuminate\Support\Facades\Schema;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\Search\ProjectSearchAction;
use Modules\Inventory\Http\Controllers\Actions\Search\UnitSearchAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitsGroupedByCityAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitPricesListAction;
use Modules\Inventory\IProject;
use Modules\Inventory\IUnit;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        app()->make('router')->aliasMiddleware('HasInventoryModule', \Modules\Inventory\Http\Middleware\HasInventoryModule::class);

        if (Schema::hasTable('i_projects')) {
            $action = new GetFooterProjectsAction;
            $footer_projects = json_decode(json_encode($action->execute()));

            $projects_count = (new ProjectSearchAction)->execute(request()->all())->count();
            View::share('footer_projects', $footer_projects);
            View::share('projects_count', $projects_count);
        }
        if (Schema::hasTable('i_purposes')) {
            $action= new GetIPurposesAction;
            $purposes = json_decode(json_encode($action->execute()));
            View::share('purposes', $purposes);
        }
        if (Schema::hasTable('i_offering_types')) {
            $action= new GetIOfferingTypesAction;
            $offering_types = json_decode(json_encode($action->execute()));
            View::share('offering_types', $offering_types);
        }

        if (Schema::hasTable('i_units')) {
            $action = new GetFooterIUnitsAction;
            $footer_units = json_decode(json_encode($action->execute()));
            View::share('footer_units', $footer_units);
            $action = new GetUnitPricesListAction;
            $unit_prices_list = $action->execute();
            View::share('unit_prices_list', $unit_prices_list);
        }
        if( Schema::hasTable('i_units') && Schema::hasTable('i_projects') && Schema::hasTable('locations') && Schema::hasTable('i_developers') ){
            $action = new GetIUnitsGroupedByCityAction;
            $discover = $action->execute();

            $units_count = (new UnitSearchAction)->execute(request()->all())->count();
            View::share('discover', $discover);
            View::share('units_count', $units_count);
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
            __DIR__.'/../Config/config.php' => config_path('inventory.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'inventory'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/inventory');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/inventory';
        }, \Config::get('view.paths')), [$sourcePath]), 'inventory');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/inventory');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'inventory');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'inventory');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
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
