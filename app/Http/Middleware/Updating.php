<?php

namespace App\Http\Middleware;

use Closure;

class Updating
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
        abort( response(view('errors.updating')) );

        return $next($request);
    }
}
