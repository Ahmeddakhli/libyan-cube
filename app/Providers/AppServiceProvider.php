<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManagerStatic;
use Validator;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Blade;
use Illuminate\Support\Facades\View;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // URL::forceScheme('https');
        Schema::defaultStringLength(191);
        ini_set('memory_limit', '8000M');

        // Has Permission Blade Directive
        Blade::directive('haspermission', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->hasPermission($expression)) { ?>";
        });
        Blade::directive('endhaspermission', function () {
            return "<?php } ?>";
        });

        Validator::extend('imageable', function ($attribute, $value, $params, $validator) {
            try {
                ImageManagerStatic::make($value);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        });

        Validator::extend('base64', function ($attribute, $value, $parameters, $validator) {
            if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $value)) {
                return true;
            } else {
                return false;
            }
        });

        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            $explode = explode(',', $value);
            $allow = ['png', 'jpg', 'svg', 'jpeg'];
            $format = str_replace(
                [
                    'data:image/',
                    ';',
                    'base64',
                ],
                [
                    '', '', '',
                ],
                $explode[0]
            );
            // check file format
            if (!in_array($format, $allow)) {
                return false;
            }
            // check base64 format
            if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                return false;
            }
            return true;
        });

        // app('debugbar')->disable();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::routes(null, []);
        // Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
    }
}
