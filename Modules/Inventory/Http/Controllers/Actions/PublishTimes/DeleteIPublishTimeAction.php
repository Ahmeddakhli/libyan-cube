<?php

namespace Modules\Inventory\Http\Controllers\Actions\PublishTimes;

use Modules\Inventory\IPublishTime;

class DeleteIPublishTimeAction
{
    public function execute($id)
    {
        // Get the i_publish_time
        $i_publish_time = IPublishTime::find($id);

        // Delete the i_publish_time
        $i_publish_time->delete();

        // Return the response
        return null;
    }
}