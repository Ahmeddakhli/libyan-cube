<?php

namespace Modules\Inventory\Http\Controllers\Actions\SellRequests;

use Lang;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Modules\Inventory\ISellRequest;
use Modules\Inventory\Jobs\ISellRequestMailJob;
use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Notifications\Jobs\GeneralNotificationJob;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Modules\Inventory\Http\Resources\ISellRequestResource;
use App\Http\Controllers\Actions\Users\GetUsersHaveEitherPermissionAction;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateISellRequestAction
{
    public function execute($data, $attachments = null)
    {
        // Create sell request 
        $i_sell_request = ISellRequest::create($data);

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();
            foreach ($attachments as $attachment) {

                $name = uniqid() . '_' . trim($attachment->getClientOriginalName());
                $attachment->move($path, $name);

                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the sell request collection
                try {
                    $i_sell_request
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,sell_requests,' . $i_sell_request->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }
            }

            if (count($errors)) {
                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        // Sending a Mail by Sell Your Unit Request
        // Prepare Mail Data
        $data['unit_name'] = $i_sell_request->unit_name;
        $data['compound'] = $i_sell_request->compound;
        $data['purpose'] = $i_sell_request->purpose->purpose;
        $data['purpose_type'] = $i_sell_request->purposeType->purpose_type;
        $data['comments'] = $i_sell_request->comments;
        $data['name'] = $i_sell_request->name;
        $data['email'] = $i_sell_request->email;
        $data['phone'] = $i_sell_request->phone;

        // Send mail to receivers
        try {
            ISellRequestMailJob::dispatch($data);
        } catch (\Exception $th) {
        }

        // Notification object construction
        $notification_object = new NotificationObject;
        $notification_object->title = $i_sell_request->name . ' ' . Lang::get('inventory::inventory.submitted_a_new_sell_request');
        $notification_object->body = $i_sell_request->name . ' ' . Lang::get('inventory::inventory.submitted_a_new_sell_request');
        $notification_object->action_url = route('inventory.sell_requests.index');
        $notification_object->created = Carbon::now()->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString();
        $notification_object->icon = 'fas fa-calendar';
        $notification_object->type = get_class(new ISellRequest);
        $notification_object->related_models = json_encode([['model_type' => get_class(new ISellRequest), 'model_id' => $i_sell_request->id]]);
        // Notify users with permissions
        $notified_users = (new GetUsersHaveEitherPermissionAction)->execute([
            'index-inventory-sell-requests'
        ]);
        GeneralNotificationJob::dispatch(request()->getHttpHost(), $notification_object, $notified_users, auth()->user());

        // Transform sell request
        $i_sell_request = new ISellRequestResource($i_sell_request);

        // Return response
        return $i_sell_request;
    }
}
