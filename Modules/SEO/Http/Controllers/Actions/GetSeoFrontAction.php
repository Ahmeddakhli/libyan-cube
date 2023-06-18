<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\SEO\Seo;
use Modules\SEO\Http\Resources\SeoResource;

class GetSeoFrontAction
{
    public function __construct()
    {
        //
    }
    public function execute()
    {
        // Get Seo
        $seo =  Seo::paginate(8);

        // Transform result
        $seo = SeoResource::collection($seo);

        $seo = new LengthAwarePaginator(
            json_decode(json_encode($seo)),
            $seo->total(),
            $seo->perPage(),
            $seo->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $seo->currentPage()
                ]
            ]
        );

        // Return the result
        return $seo;
    }
}
