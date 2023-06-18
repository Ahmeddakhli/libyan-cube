<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->group && in_array(Auth::user()->group->slug, ['brokers', 'developers', 'owners', 'buyers'])) {
            return $next($request);
        } else {
            abort(401);
        }
    }
}
