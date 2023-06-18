<?php

namespace Modules\Settings\Http\Controllers\Actions\Logos;

use Modules\Settings\Logo;
use Modules\Settings\Http\Resources\Logos\LogoResource;
use Cache;
use App;

class GetFrontLogosAction
{
    public function execute()
    {
        $header_logo = Logo::where('type', 'header')->where('key', 'logo')->latest()->first();
        $footer_logo = Logo::where('type', 'footer')->where('key', 'logo')->latest()->first();

        // Transform the logos
        $logos = [
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
        ];

        return $logos;
    }
}
