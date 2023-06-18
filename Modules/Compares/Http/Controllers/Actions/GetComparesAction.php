<?php

namespace Modules\Compares\Http\Controllers\Actions;

use Modules\Compares\Compare;
use Modules\Compares\Http\Resources\CompareResource;
use Auth;

class GetComparesAction
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
        $compares = $compares->whereHas('unit')->orderBy('order');
        
        return CompareResource::collection($compares->get());
    }
}
