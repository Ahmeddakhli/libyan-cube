<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Mail;
use Modules\Careers\Mail\ApplyCareer;
use Modules\Careers\Career;
use Modules\Settings\Contact;
use Throwable;

class ApplyCareerAction
{
    public function execute($data, $attachment = null)
    {
        // Get the career
        $career = Career::find($data['career_id']);

        // Get the contacts
        $contacts = Contact::where('type', 'careers')->get();

        // Prepare Mail Data
        $subject = $career->value.' Application';
        $sender = $sender = env('MAIL_NO_REPLY');;
        $data['career_name'] = $career->value;


        // Send mail to receivers
        try {
            foreach ($contacts as $contact) {
                Mail::to($contact->value)->send(new ApplyCareer($subject, $sender, $data, $attachment));
            }
                Mail::to('mohamed_alansary@rocketmail.com')->send(new ApplyCareer($subject, $sender, $data, $attachment));
            return true;
        } catch (Throwable $th) {
            // return $th->getMessage();
        }

        return true;
    }
}
