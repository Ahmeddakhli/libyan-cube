<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Contactus;

use App\Http\Controllers\Actions\Users\GetUsersHaveEitherPermissionAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Modules\ContactUS\Mail\ContactUsMail as MailContactUs;
use Modules\ContactUS\ContactUs;
use Mail;
use Modules\ContactUS\Http\Resources\ContactUsResource;
use Modules\ContactUS\Jobs\MailUser;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Modules\Notifications\Jobs\GeneralNotificationJob;
use Modules\Settings\Contact;

class CreateContactUsAction
{
    public function execute(array $data): ContactUsResource
    {
        if (isset($data['best_time_to_call_from']) && !is_null($data['best_time_to_call_from'])) {
            $data['best_time_to_call_from'] = date('Y-m-d H:i:s', strtotime($data['best_time_to_call_from']));
        }

        // Set type if not decleared
        $data['type'] = isset($data['type']) ? (!is_null($data['type']) ? $data['type'] : 'contact') : 'contact';
        // Create contact us
        $contact_us = ContactUs::create($data);

        // Trigger update contact on contact to cache its values
        $contact_us->update();

        // Reload the instance
        $contact_us = ContactUs::find($contact_us->id);
        $data['urls'] = null;
        // Job Of mailing and pass data to crm

        try {
            MailUser::dispatch($data);
        } catch (\Exception $th) {
        }

        // Notification object construction
        $notification_object = new NotificationObject;
        $notification_object->title = Lang::get('contactus::contact_us.new_contact_us_message') . ' ' . Lang::get('contactus::contact_us.from') . ' ' . $contact_us->full_name;
        $notification_object->body = $contact_us->message;
        $notification_object->action_url = route('contact_us.contact_us.index', ['id' => $contact_us->id]);
        $notification_object->created = Carbon::now()->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString();
        $notification_object->icon = 'fas fa-inbox';
        $notification_object->type = get_class(new ContactUs);
        $notification_object->related_models = json_encode([['model_type' => get_class(new ContactUs), 'model_id' => $contact_us->id]]);
        // Notify users with permissions
        $notified_users = (new GetUsersHaveEitherPermissionAction)->execute([
            'index-contact-us'
        ]);
        GeneralNotificationJob::dispatch(request()->getHttpHost(), $notification_object, $notified_users, auth()->user());

        // Transform the result
        $contact_us = new ContactUsResource($contact_us);

        return $contact_us;
    }
}
