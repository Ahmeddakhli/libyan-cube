<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Cache, DB;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('hasmodule', function ($module) {
            // Workaround for locahost use
            $current_host = request()->getHttpHost();
            $current_host = str_replace(":8000","",$current_host);
            $current_host = str_replace(":8080","",$current_host);

            // Transform module name to cached module name
            $module_transformed = explode(' ', $module);
            for ($i = 0; $i < count($module_transformed); $i++) {
                $module_transformed[$i] = strtolower($module_transformed[$i]);
            }
            $module_transformed = implode('_', $module_transformed);

            // Check the hostnames that has this module
            $has_module = Cache::rememberForever('has_'.$module_transformed, function() use ($current_host, $module) {
                // Remove single quotes
                $module = substr($module, 1);
                $module = substr($module, 0, -1);

                $current_module = DB::connection('mysql')->table('modules')->where('name', $module)->first();

                if (!$current_module) { return false; }
                $current_module_packages = DB::connection('mysql')->table('package_modules')->where('module_id', $current_module->id)->pluck('package_id')->toArray();
                $package_hosts = DB::connection('mysql')->table('host_details')->whereIn('package_id', $current_module_packages)->pluck('fqdn')->toArray();
                return in_array($current_host, $package_hosts);
            });

            return $has_module ? "<?php if (true) { ?>" : "<?php if (false) { ?>";
        });
        Blade::directive('endhasmodule', function () {
            return "<?php } ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
