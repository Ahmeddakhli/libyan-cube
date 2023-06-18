<?php

namespace Modules\Messages\Http\Controllers\Actions;

use Modules\Messages\Message;
use Modules\Messages\Http\Resources\MessageResource;

class UpdateMessageAction
{
    function execute($id, $data)
    {
        // Get message
        $message = Message::find($id);

        // Update message
        $message->update($data);

        // Return transformed response
        return new MessageResource($message);
    }
}
