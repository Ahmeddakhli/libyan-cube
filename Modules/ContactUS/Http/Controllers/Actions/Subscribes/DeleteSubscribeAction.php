<?php

namespace Modules\ContactUS\Http\Controllers\Actions\Subscribes;

use Modules\ContactUS\Subscribe;


class DeleteSubscribeAction
{
    public function execute($id)
    {
        // find the subscribe
        $subscribe = Subscribe::find($id);

        // Delete subscribe
        $subscribe->delete();

        // Return the response 
        return null;
    }
}
