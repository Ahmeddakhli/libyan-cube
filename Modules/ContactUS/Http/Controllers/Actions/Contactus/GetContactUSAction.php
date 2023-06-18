<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use Cache;
use Modules\ContactUS\ContactUs;
use Modules\ContactUS\Http\Resources\ContactUsResource;

class GetContactUSAction
{
    public function execute()
    {
        // Get contact us list 
        $contact_us = ContactUs::all();

        // Transform the contact us list 
        $contact_us = ContactUsResource::collection($contact_us);

        // Return the response 
        return $contact_us;
    }
}
