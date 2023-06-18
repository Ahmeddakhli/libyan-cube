<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use Modules\ContactUS\ContactUs;
use Modules\ContactUS\Http\Resources\ContactUsResource;

class UpdateContactUsAction
{
    public function execute($id, array $data): ContactUsResource
    {
        // Find contact us 
        $contact_us = ContactUs::find($id);

        // Trigger update ContactUs on ContactUs to cache its values
        // Update contact us
        $contact_us->update($data);

        // Transform the result
        $contact_us = new ContactUsResource($contact_us);

        // Return the response 
        return $contact_us;
    }
}
