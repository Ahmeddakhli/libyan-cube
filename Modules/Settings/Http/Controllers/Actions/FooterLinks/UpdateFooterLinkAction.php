<?php

namespace Modules\Settings\Http\Controllers\Actions\FooterLinks;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\FooterLink;
use Modules\Settings\FooterLinkTranslation;
use Modules\Settings\Http\Resources\FooterLinks\FooterLinkResource;

class UpdateFooterLinkAction
{
    function execute($id, $data, $translations = null)
    {
        // Find footer link
        $footer_link = FooterLink::find($id);

        // Create\Update translation
        foreach ($translations as $translation) {
            $footer_linkTrans = FooterLinkTranslation::where('footer_link_id', $footer_link->id)->where('language_id', $translation['language_id'])->first();

            $translation['footer_link_id'] = $footer_link->id;

            if ($footer_linkTrans) {
                FooterLinkTranslation::where('footer_link_id', $footer_link->id)->where('language_id', $translation['language_id'])->update($translation);
            } else {
                FooterLinkTranslation::insert($translation);
            }
        }

        // Update footer link
        $footer_link->update($data);

        // Return transformed response
        return new FooterLinkResource($footer_link);
    }
}
