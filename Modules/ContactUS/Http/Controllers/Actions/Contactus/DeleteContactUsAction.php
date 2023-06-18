<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use Modules\ContactUS\ContactUs;


class DeleteContactUsAction
{
    public function execute($id)
    {
        // find the contact us
        $contact_us = ContactUs::find($id);

        // Delete contact us
        $contact_us->delete();

        // Return the response 
        return null;
    }
}
