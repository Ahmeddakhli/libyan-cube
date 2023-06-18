<?php

namespace Modules\Compares\Http\Controllers\Actions;

use Modules\Compares\Compare;
use Modules\Compares\Http\Resources\CompareExportResource;
use Auth;

class GetExportComparesAction
{
    public function execute()
    {
        $compares = new Compare;

        // If authenticated user
        if (Auth::check()) {
            $compares = $compares->where('user_id',auth()->user()->id);
        } else {
            // Guest session
            $session = request()->session()->get('_token');
            $compares = $compares->where('session', $session);
        }
        $compares = $compares->orderBy('order')->take(3);
        
        return CompareExportResource::collection($compares->get());
    }
}
