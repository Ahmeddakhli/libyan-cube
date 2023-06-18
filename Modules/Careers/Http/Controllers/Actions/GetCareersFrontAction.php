<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Careers\Career;
use Modules\Careers\Http\Resources\CareerResource;

class GetCareersFrontAction
{
    public function __construct()
    {
        //
    }
    public function execute()
    {
        // Get Careers
        $careers =  Career::paginate(8);

        // Transform result
        $careers = CareerResource::collection($careers);

        $careers = new LengthAwarePaginator(
            json_decode(json_encode($careers)),
            $careers->total(),
            $careers->perPage(),
            $careers->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $careers->currentPage()
                ]
            ]
        );

        // Return the result
        return $careers;
    }
}
