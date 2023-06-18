<?php

namespace Modules\Settings\Http\Controllers\Actions\FooterLinks;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\FooterLink;
use Modules\Settings\FooterLinkTranslation;
use Modules\Settings\Http\Resources\FooterLinks\FooterLinkResource;

class CreateFooterLinkAction
{
    function execute($data, $translations = null)
    {
        // Create footer link
        $footer_link = FooterLink::create($data);

        // Create translations
        foreach ($translations as $translation) {
            $translation['footer_link_id'] = $footer_link->id;

            FooterLinkTranslation::insert($translation);
        }

        // update for cache translations
        $footer_link->update();

        // Return transfromed response
        return new FooterLinkResource(FooterLink::find($footer_link->id));
    }
}
