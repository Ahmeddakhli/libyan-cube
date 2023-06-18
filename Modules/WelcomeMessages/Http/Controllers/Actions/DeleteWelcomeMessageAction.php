<?php

namespace Modules\WelcomeMessages\Http\Controllers\Actions;

use Modules\WelcomeMessages\WelcomeMessage;

class DeleteWelcomeMessageAction
{
    public function execute($id)
    {
        $welcome_message = WelcomeMessage::find($id)->delete();
        return $welcome_message;
    }
}
