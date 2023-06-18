<?php

namespace Modules\Compares\Http\Controllers\Actions;

use Auth;
use Modules\Compares\Compare;
use Modules\Compares\Http\Resources\CompareResource;

class CreateCompareAction
{
    public function execute($data)
    {
        // If authenticated user
        if (Auth::check()) {
            if (Compare::where('user_id', Auth::user()->id)->where('unit_id', $data['unit_id'])->first()) {
                Compare::where('user_id', Auth::user()->id)->where('unit_id', $data['unit_id'])->delete();
                $compare['message'] = trans('compares::compare.removed_from_compare_successfully');
                $compare['action'] = 'delete';
            } else {
                $last = Compare::where('user_id', Auth::user()->id)->latest()->first();
                Compare::create([
                    'user_id' => Auth::user()->id,
                    'unit_id' => $data['unit_id'],
                    'order'  => $last ? $last->order+1 :1 
                ]);
                $compare['message'] = trans('compares::compare.added_to_compare_successfully');
                $compare['action'] = 'create';
            }
        } else {
            // Guest session
            if (Compare::where('session', request()->session()->get('_token'))->where('unit_id', $data['unit_id'])->first()) {
                Compare::where('session', request()->session()->get('_token'))->where('unit_id', $data['unit_id'])->delete();
                $compare['message'] = trans('compares::compare.removed_from_compare_successfully');
                $compare['action'] = 'delete';
            } else {
                $last = Compare::where('session',request()->session()->get('_token'))->latest()->first();
                Compare::create([
                    'unit_id' => $data['unit_id'],
                    'session' => request()->session()->get('_token'),
                    'order'  => $last ? $last->order+1 :1 
                ]);
                $compare['message'] = trans('compares::compare.added_to_compare_successfully');
                $compare['action'] = 'create';
            }
        }

        $action = new GetComparesAction;
        $compare['count'] = $action->execute()->count();

        // Return response
        return $compare;
    }
}
