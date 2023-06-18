<?php

namespace Modules\Inventory\Http\Controllers\Actions\PublishTimes;

use Cache;
use Modules\Inventory\IPublishTime;
use Modules\Inventory\Http\Resources\IPublishTimeResource;

class GetIPublishTimesAction
{
    public function execute()
    {
        // Get  publish times
        $i_publish_times = IPublishTime::all();

        // Transform the i_publish_times
        $i_publish_times = IPublishTimeResource::collection($i_publish_times);

        return $i_publish_times;
    }
}