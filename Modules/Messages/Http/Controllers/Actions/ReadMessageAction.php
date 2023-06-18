<?php

namespace Modules\Messages\Http\Controllers\Actions;

use Modules\Messages\Message;

class ReadMessageAction
{
    public function execute($id)
    {
        // Delete message
        $message = Message::where('id', $id)->update([
            'is_readed' => 1
        ]);

        // Return the response
        return null;
    }
}
