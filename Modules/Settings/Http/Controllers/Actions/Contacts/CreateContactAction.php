<?php

namespace Modules\Settings\Http\Controllers\Actions\Contacts;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\Contact;
use Modules\Settings\Http\Resources\Contacts\ContactResource;

class CreateContactAction
{
    function execute($data)
    {
        // Create setting
        $setting = Contact::create($data);

        // return transformed response
        return new ContactResource($setting);
    }
}
