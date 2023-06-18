<?php

namespace Modules\Messages\Http\Controllers\Actions;

use Modules\Messages\Message;

class DeleteMessageAction
{
    public function execute($id)
    {
        // Delete message
        $message = Message::find($id)->delete();

        // Return the response
        return null;
    }
}
