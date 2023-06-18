<?php

namespace Modules\Messages\Http\Controllers\Actions;

use App\Http\Controllers\Actions\Users\GetUsersHaveEitherPermissionAction;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Modules\Inventory\IDeveloper;
use Modules\Messages\Message;
use Modules\Messages\Http\Resources\MessageResource;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Modules\Notifications\Jobs\GeneralNotificationJob;
use Modules\ContactUS\Mail\ContactUsMail;

class CreateMessageAction
{
    function execute($data)
    {
        // Create message
        $message = Message::create($data);

        if ($data['developer_id']) {
            $developer = IDeveloper::find($data['developer_id']);
            if ($developer && $developer->developer_email) {
                $subject = "التواصل مع المطور";
                $sender = $data['email'];
                Mail::to($developer->developer_email)->send(new ContactUsMail($subject, $sender, $data));
            }
        }

        // Notification object construction
        $notification_object = new NotificationObject;
        $notification_object->title = Lang::get('messages::message.new_message') . ' ' . Lang::get('messages::message.from') . ' ' . $message->name;
        $notification_object->body = $message->message;
        $notification_object->action_url = route('messages.index', ['id' => $message->id]);
        $notification_object->created = Carbon::now()->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString();
        $notification_object->icon = 'fas fa-envelope';
        $notification_object->type = get_class(new Message());
        $notification_object->related_models = json_encode([['model_type' => get_class(new Message()), 'model_id' => $message->id]]);

        // Notify users with permissions
        $notified_users = (new GetUsersHaveEitherPermissionAction)->execute([
            'index-messages'
        ]);
        GeneralNotificationJob::dispatch(request()->getHttpHost(), $notification_object, $notified_users, auth()->user());

        // Return transformed response 
        return new MessageResource($message);
    }
}
