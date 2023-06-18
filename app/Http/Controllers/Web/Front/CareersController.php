<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Careers\Http\Controllers\Actions\GetCareerByIdAction;
use Modules\Careers\Http\Controllers\Actions\GetCareersAction;

class CareersController extends Controller
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
    public function index()
    {
        $action =  new GetCareersAction;
        $careers = json_decode(json_encode($action->execute()));

        $features = $this->features();
        $features['careers'] = $careers;

        return view('front.pages.careers', $features);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, GetCareerByIdAction $action)
    {
        // Get career
        $career = $action->execute($id);

        if (!$career) {
            abort(404);
        } else {
            $career = json_decode(json_encode($career));
        }

        $features = $this->features();
        $features['career'] = $career;

        return view('front.pages.career', $features);
    }
}
