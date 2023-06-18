<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitByIdAction;
use Modules\Inventory\IPublishTime;

class LandingPagesController extends Controller
{
    public function index($id)
    {
        // Get Unit 
        $action = new GetIUnitByIdAction;
        $unit = json_decode(json_encode($action->execute($id)));

        // Check if unit has publish time or abouts error 404 
        $publish_time = IPublishTime::where('i_unit_id',$id)
            ->where(function($query) {
                $query->where('from', '<=', date('Y-m-d H:i:s', strtotime(Carbon::now())))->where('to','>=',date('Y-m-d H:i:s', strtotime(Carbon::now())));
            })->orWhere(function($query) {
                $query->where('from', '<=', date('Y-m-d H:i:s', strtotime(Carbon::now())))->whereNull('to');
            })->first();

        if ($publish_time) {
            return view('front.pages.landing_page', compact('unit'));
        } else {
            return abort(404);
        }
    }
}
