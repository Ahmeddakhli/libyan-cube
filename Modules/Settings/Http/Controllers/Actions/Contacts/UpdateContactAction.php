<?php

namespace Modules\Settings\Http\Controllers\Actions\Contacts;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Settings\Contact;
use Modules\Settings\Http\Resources\Contacts\ContactResource;

class UpdateContactAction
{
    function execute($id, $data)
    {
        // Find contact
        $contact = Contact::find($id);
        
        // Update contact 
        $contact->update($data);

        // Return transformed response
        return new ContactResource($contact);
    }
}
