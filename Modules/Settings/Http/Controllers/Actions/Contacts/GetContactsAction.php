<?php

namespace Modules\Settings\Http\Controllers\Actions\Contacts;

use Modules\Settings\Contact;
use Modules\Settings\Http\Resources\Contacts\ContactResource;
use Cache;
use App;

class GetContactsAction
{
    public function execute()
    {
        return Cache::rememberForever('settings_module_contacts_'.App::getLocale(), function() {
            $contacts = Contact::all();

            // Transform the contacts
            $contacts = ContactResource::collection($contacts);

            return $contacts;
        });
    }
}
