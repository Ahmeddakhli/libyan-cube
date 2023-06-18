<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Modules\SEO\Seo;
use Modules\SEO\Http\Resources\SeoResource;

class GetSeoByIdAction
{
    public function execute($id)
    {
    	// Get the seo
        $seo = Seo::find($id);

        // Return the response
        return $seo ? new SeoResource($seo) : null;
    }
}
