<?php

namespace Modules\WelcomeMessages\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\WelcomeMessages\WelcomeMessage;
use Modules\WelcomeMessages\WelcomeMessageTranslation;
use Modules\WelcomeMessages\Http\Resources\WelcomeMessageResource;

class CreateWelcomeMessageAction
{
    function execute($data, $translations = null)
    {
        $welcome_message = WelcomeMessage::create($data);
        foreach ($translations as $value) {
            WelcomeMessageTranslation::insert([
                'language_id' => $value['language_id'],
                'title' => $value['title'],
                'welcome_message_id' => $welcome_message->id
            ]);
        }

        // Load welcome message translations
        $welcome_message->update();

        return new WelcomeMessageResource($welcome_message);
    }
}
