<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Subscribes;

use Modules\ContactUS\Subscribe;
use Modules\ContactUS\Http\Resources\SubscribeResource;
use App\Http\Controllers\Actions\Users\GetUsersHaveEitherPermissionAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Modules\Notifications\Jobs\GeneralNotificationJob;

class CreateSubscribeAction
{
    public function execute(array $data): SubscribeResource
    {
        // Create subscribe
        $subscribe = Subscribe::create($data);

        // Notification object construction
        $notification_object = new NotificationObject;
        $notification_object->title = Lang::get('contactus::contact_us.new_subsription_from') .' '.$subscribe->email;
        $notification_object->body = Lang::get('contactus::contact_us.new_subsription_from') .' '.$subscribe->email;
        $notification_object->action_url = route('contact_us.subscribes.index', ['id' => $subscribe->id]);
        $notification_object->created = Carbon::now()->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString();
        $notification_object->icon = 'fas fa-at';
        $notification_object->type = get_class(new Subscribe);
        $notification_object->related_models = json_encode([['model_type' => get_class(new Subscribe), 'model_id' => $subscribe->id]]);
        // Notify users with permissions
        $notified_users = (new GetUsersHaveEitherPermissionAction)->execute([
            'index-subscribe-mails'
        ]);
        GeneralNotificationJob::dispatch(request()->getHttpHost(), $notification_object, $notified_users, auth()->user());

        // Transform the result
        $subscribe = new SubscribeResource($subscribe);

        return $subscribe;
    }
}
