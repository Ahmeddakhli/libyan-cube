<?php

namespace Modules\Settings\Http\Controllers\Actions\FooterLinks;

use Modules\Settings\FooterLink;
use Modules\Settings\Http\Resources\FooterLinks\FooterLinkResource;
use Cache;
use App;

class GetFooterLinksAction
{
    public function execute()
    {
        return Cache::rememberForever('settings_module_footer_links_'.App::getLocale(), function() {
            $footer_links = FooterLink::all();

            // Transform the footer links
            $footer_links = FooterLinkResource::collection($footer_links);

            return $footer_links;
        });
    }
}
