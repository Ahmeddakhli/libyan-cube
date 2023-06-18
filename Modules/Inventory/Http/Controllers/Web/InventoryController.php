<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        //
    }

    public function settings(Request $request)
    {
        $blade_name = ($request->ajax() ? 'settings-partial' : 'settings'); // Handle Partial Return
        return view('inventory::settings.' . $blade_name);
    }
}
