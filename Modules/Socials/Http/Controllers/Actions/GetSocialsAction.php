<?php

namespace Modules\Socials\Http\Controllers\Actions;

use Modules\Socials\Http\Resources\SocialResource;
use Modules\Socials\Social;

class GetSocialsAction
{
    public function execute()
    {
        // Get socials
        $socials = Social::where('is_featured',1)->get();

        // Return transformed response
        return SocialResource::collection($socials);
    }
}
