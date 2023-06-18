<?php

namespace Modules\Settings\Http\Controllers\Actions\Contacts;

use Modules\Settings\Contact;

class DeleteContactAction
{
    public function execute($id)
    {
        // Delete contact 
        Contact::find($id)->delete();

        // return the response
        return null;
    }
}
