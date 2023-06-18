<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use DateTime;

class LastSeen
{

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        // $redis = Redis::connection();

        // $key = '_last_seen_' . Auth::id();
        // $value = (new DateTime())->format("Y-m-d H:i:s");
      
        // $redis->set($key, $value);

        return $next($request);
    }
}