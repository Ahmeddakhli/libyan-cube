<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Cache;
use Modules\SEO\Seo;
use Modules\SEO\Http\Resources\SeoResource;

class GetSeoAction
{
    public function execute()
    {
        // Get the seo
        $seo = Seo::all();

        // Transform the seo
        $seo = SeoResource::collection($seo);

        // Return the seo
        return $seo;
    }
}
