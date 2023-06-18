<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use Modules\ContactUS\ContactUs;


class ReadContactUsAction
{
    public function execute($id)
    {
        // find the contact us
        $contact_us = ContactUs::where('id', $id)->update([
            'is_readed' => 1
        ]);

        // Return the response 
        return null;
    }
}
