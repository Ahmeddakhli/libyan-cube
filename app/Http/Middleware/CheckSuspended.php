<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Lang;

class CheckSuspended
{
    public function handle($request, Closure $next) {
        if (auth()->check() && auth()->user()->is_suspended) {
            $message = Lang::get('auth.your_account_has_been_suspended');        
            auth()->logout();     
            return response()->json(['error' => $message], 401);
        }
        return $next($request);
    }
}