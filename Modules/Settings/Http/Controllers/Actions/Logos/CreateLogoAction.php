<?php

namespace Modules\Settings\Http\Controllers\Actions\Logos;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\Logo;
use Modules\Settings\Http\Resources\Logos\LogoResource;

class CreateLogoAction
{
    function execute($data)
    {
        // Create logo 
        $logo = Logo::create($data);

        // return transformed response
        return new LogoResource($logo);
    }
}
