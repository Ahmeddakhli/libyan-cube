<?php

namespace Modules\Notifications\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Modules\Notifications\Events\NotificationRead;
use Modules\Notifications\Events\NotificationReadAll;
use NotificationChannels\WebPush\PushSubscription;
use Illuminate\Routing\Controller;
use Modules\Notifications\Notifications\GeneralNotification;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Carbon\Carbon;
use App\Http\Helpers\ServiceResponse;

class NotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get user's notifications.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Limit the number of returned notifications, or return all
        $query = $user->unreadNotifications();
        $limit = (int) $request->input('limit', 0);
        if ($limit) {
            $query = $query->limit($limit);
        }

        $notifications = $query->get()->each(function ($n) {
            // $n->created = $n->created_at->diffForHumans();
            $n->created = $n->created_at->timezone(auth()->user()->timezone)->diffForHumans();
        });

        $total = $user->unreadNotifications->count();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Notifications retrieved successfully';
        $resp->status = true;
        $resp->data = [
            'notifications' => $notifications,
            'total' => $total
        ];
        return response()->json($resp, 200);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        $notification = $request->user()
                                ->unreadNotifications()
                                ->where('id', $request->input('id'))
                                ->first();

        if (is_null($notification)) {
            $resp = new ServiceResponse;
            $resp->message = 'Notification not found.';
            $resp->status = false;
            $resp->data = null;

            return response()->json($resp, 200);
        }

        $notification->markAsRead();

        event(new NotificationRead(request()->getHttpHost(), $request->user()->id, $request->input('id')));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Notfication read successfully';
        $resp->status = true;
        $resp->data = $notification;

        return response()->json($resp, 200);
    }

    /**
     * Mark all user's notifications as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function markAllRead(Request $request)
    {
        $request->user()
                ->unreadNotifications()
                ->get()->each(function ($n) {
                    $n->markAsRead();
                });

        event(new NotificationReadAll(request()->getHttpHost(), $request->user()->id));

        $resp = new ServiceResponse;
        $resp->message = 'Notifications read successfully';
        $resp->status = true;
        $resp->data = null;

        return response()->json($resp, 200);
    }
}
