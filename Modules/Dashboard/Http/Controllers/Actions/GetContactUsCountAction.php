<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use Modules\ContactUS\ContactUs;

class GetContactUsCountAction
{
    public function execute()
    {
        // Get Count Contact Us 
        $contact_us = ContactUs::count();

        return $contact_us;
    }
}
