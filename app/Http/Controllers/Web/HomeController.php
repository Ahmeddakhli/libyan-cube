<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Modules\ContactUS\ContactUs;
use Modules\Inventory\IDeveloper;
use Modules\Inventory\IProject;
use Modules\Inventory\ISellRequest;
use Modules\Inventory\IUnit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

 
}
