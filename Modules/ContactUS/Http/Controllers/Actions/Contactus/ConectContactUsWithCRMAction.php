<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use Cache;
use Modules\ContactUS\ContactUs;
use Modules\ContactUS\Http\Resources\ContactUsResource;
use Modules\Settings\Contact;
use Mail;
use Modules\ContactUS\Mail\ContactUsMail as MailContactUs;

class ConectContactUsWithCRMAction
{
    public function execute($request)
    {
        $contact_us_mails = Contact::where('type', 'contact_us')->get();
        $subject = 'Contact US';
        $sender = env('MAIL_NO_REPLY');
        $best_from = isset($data['best_time_to_call_from']) && !is_null($data['best_time_to_call_from']) ? $data['best_time_to_call_from'] : '';
        $best_to = isset($data['best_time_to_call_to']) && !is_null($data['best_time_to_call_to']) ? $data['best_time_to_call_to'] : '';
        $access_data = $this->getToken();
        if (!isset($access_data['error']) && isset($access_data["token_type"])) {
            $token_type = $access_data["token_type"];
            $expires_in = $access_data["expires_in"];
            $access_token = $access_data["access_token"];
            $refresh_token = $access_data["refresh_token"];

            $message_data = [
                'full_name' => $request['full_name'],
                'description' => $request['model_name'],
                'phones' => [
                    [
                        'phone' => $request['phone'],
                        'country_code' => ''
                    ]
                ]
            ];
            // Init the connection
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env('CRM_URL') . "/api/v1/lead_generation/web_form_routings/storeLead");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message_data));
            // Append the headers
            $headers = array();
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            $headers[] = "Authorization:" . "$token_type" . ' ' . "$access_token";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // Get the connection
            $result = curl_exec($ch);
            // Prepare the data
            $data = json_decode($result, true);
            // Handle the error
            if (curl_errno($ch)) {
                echo "Error:" . curl_error($ch);
            }
            if (isset($data['errors'])) {
                try {
                    $request['error_message'] = "This customer has been registered on website but not created on CRM";
                    foreach ($contact_us_mails as $contact_us_mail) {
                        Mail::to($contact_us_mail->value)->send(new MailContactUs($subject, $sender, $request, $best_from, $best_to));
                    }
                } catch (\Exception $th) {
                }
            }
            // Close the connection
            curl_close($ch);
        } else {
            try {
                $request['error_message'] = "This customer has been registered on website but not created on CRM";
                foreach ($contact_us_mails as $contact_us_mail) {
                    Mail::to($contact_us_mail->value)->send(new MailContactUs($subject, $sender, $request, $best_from, $best_to));
                }
            } catch (\Exception $th) {
            }
        }
    }


    public function getToken()
    {
        $credentials = [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => env('CLIENT_SECRET'),
            'username' => env('CRM_USERNAME'),
            'password' => env('CRM_PASSWORD')
        ];
        // Init the connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('CRM_URL') ."/oauth/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
        // Append the headers
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Accept: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get the connection
        $result = curl_exec($ch);
        // Prepare the data
        $data = json_decode($result, true);
        // Handle the error
        if (curl_errno($ch)) {
            echo "Error:" . curl_error($ch);
        }
        // Close the connection
        curl_close($ch);

        return $data;
    }
}
