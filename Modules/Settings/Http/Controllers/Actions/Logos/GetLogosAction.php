<?php

namespace Modules\Settings\Http\Controllers\Actions\Logos;

use Modules\Settings\Logo;
use Modules\Settings\Http\Resources\Logos\LogoResource;
use Cache;
use App;

class GetLogosAction
{
    public function execute()
    {
        return Cache::rememberForever('settings_module_logos_'.App::getLocale(), function() {
            $logos = Logo::all();

            // Transform the logos
            $logos = LogoResource::collection($logos);

            return $logos;
        });
    }
}
