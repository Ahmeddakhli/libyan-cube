<?php

namespace App\Http\Middleware;

use App\Jobs\FireWelcomeMessagesJob;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\WelcomeMessages\Http\Controllers\Actions\GetWelcomeMessagesAction;

class WelcomeMessages
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
        $check_fired_messages = DB::table('fired_messages')->where('session',request()->session()->get('_token'))->first();
        $welcome_messages = json_decode(json_encode((new GetWelcomeMessagesAction)->execute()));

        if(!$check_fired_messages){
            foreach ($welcome_messages as $welcome_message) {
                FireWelcomeMessagesJob::dispatch($welcome_message)->delay($welcome_message->time);
            }
        }
        return $next($request);
    }
}
