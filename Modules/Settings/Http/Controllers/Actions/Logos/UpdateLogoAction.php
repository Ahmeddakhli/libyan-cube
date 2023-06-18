<?php

namespace Modules\Settings\Http\Controllers\Actions\Logos;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\Logo;
use Modules\Settings\Http\Resources\Logos\LogoResource;

class UpdateLogoAction
{
    function execute($id, $data)
    {
        // Find logo 
        $logo = Logo::find($id);
        
        // Update logo 
        $logo->update($data);

        // Return transformed response
        return new LogoResource($logo);
    }
}
