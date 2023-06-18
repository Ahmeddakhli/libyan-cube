<?php

namespace Modules\Inventory\Http\Controllers\Actions\PublishTimes;

use Modules\Inventory\IPublishTime;
use Modules\Inventory\Http\Resources\IPublishTimeResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Lang;
use Carbon\Carbon;

class UpdateIPublishTimeAction
{
    public function execute($id, array $data): IPublishTimeResource
    {
        // Transform from date
        if (isset($data['from'])) {
            // Create from date in user timezone then convert to UTC
            $from = Carbon::createFromFormat('Y-m-d H:i', $data['from'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->toDateTimeString();
            $data['from'] = $from;
        }
        // Transform to date
        if (isset($data['to'])) {
            // Create to date in user timezone then convert to UTC
            $to = Carbon::createFromFormat('Y-m-d H:i', $data['to'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->toDateTimeString();
            $data['to'] = $to;
        }

        // Get the i_publish_time
        $i_publish_time = IPublishTime::find($id);

        // Update the i_publish_time
        $i_publish_time->update($data);

        // Transform the result
        $i_publish_time = new IPublishTimeResource($i_publish_time);

        // Return the response
        return $i_publish_time;
    }
}
