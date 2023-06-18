<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Services\Http\Controllers\Actions\Services\GetServicesFrontAction;

class ServicesController extends Controller
{
    public function features()
    {
        return [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetServicesFrontAction $action)
    {
        $services = $action->execute();

        $features = $this->features();
        $features['services'] = $services;

        return view('front.pages.services', $features);
    }
}
