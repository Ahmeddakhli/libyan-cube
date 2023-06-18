<?php

namespace Modules\Blog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Cache;

class HasBlogModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Workaround for locahost use
        $current_host = request()->getHttpHost();
        $current_host = str_replace(":8000", "", $current_host);
        $current_host = str_replace(":8080", "", $current_host);

        // Check the hostnames that has this module
        // Provide the hosts that are allowed to use the blog module
        $hosts = Cache::rememberForever('has_blog_module', function () {
            $blog_module = DB::connection('mysql')->table('modules')->where('name', 'Blog Module')->first();
            $blog_module_packages = DB::connection('mysql')->table('package_modules')->where('module_id', $blog_module->id)->pluck('package_id')->toArray();
            $package_hosts = DB::connection('mysql')->table('host_details')->whereIn('package_id', $blog_module_packages)->pluck('fqdn')->toArray();
            return $package_hosts;
        });
        if (!in_array($current_host, $hosts)) :
            abort(404);
        endif;

        return $next($request);
    }
}
