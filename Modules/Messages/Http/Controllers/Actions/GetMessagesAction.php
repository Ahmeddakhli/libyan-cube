<?php

namespace Modules\Messages\Http\Controllers\Actions;

use Modules\Messages\Message;
use Modules\Messages\Http\Resources\MessageResource;

class GetMessagesAction
{
    public function execute()
    {
        // Get messages 
        $messages = Message::all();
        
        // Return transformed response 
        return MessageResource::collection($messages);
    }
}
