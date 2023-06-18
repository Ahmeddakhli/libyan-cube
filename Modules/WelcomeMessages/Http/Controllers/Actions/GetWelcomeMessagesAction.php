<?php

namespace Modules\WelcomeMessages\Http\Controllers\Actions;

use Modules\WelcomeMessages\WelcomeMessage;
use Modules\WelcomeMessages\Http\Resources\WelcomeMessageResource;
use Cache;
use App;

class GetWelcomeMessagesAction
{
    public function execute()
    {
        // Get welcome_messages
        $welcome_messages = WelcomeMessage::all();

        // Transform the welcome_messages
        $welcome_messages = WelcomeMessageResource::collection($welcome_messages);

        return $welcome_messages;
    }
}
