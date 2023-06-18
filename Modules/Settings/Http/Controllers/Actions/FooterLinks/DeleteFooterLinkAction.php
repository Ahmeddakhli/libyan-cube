<?php

namespace Modules\Settings\Http\Controllers\Actions\FooterLinks;

use Modules\Settings\FooterLink;

class DeleteFooterLinkAction
{
    public function execute($id)
    {
        // Delete footer link
        FooterLink::find($id)->delete();

        // Return response
        return null;
    }
}
