<?php

namespace Modules\WelcomeMessages\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\WelcomeMessages\WelcomeMessage;
use Modules\WelcomeMessages\WelcomeMessageTranslation;
use Modules\WelcomeMessages\Http\Resources\WelcomeMessageResource;

class UpdateWelcomeMessageAction
{
    function execute($id, $data, $translations = null)
    {
        // Get welcome message section
        $welcome_message = WelcomeMessage::find($id);

        foreach ($translations as $value) {
            $welcome_message_translation = WelcomeMessageTranslation::where('welcome_message_id', $welcome_message->id)->where('language_id', $value['language_id'])->first();
            $value['welcome_message_id'] = $welcome_message->id;
            if ($welcome_message_translation) {
                WelcomeMessageTranslation::where('welcome_message_id', $welcome_message->id)->where('language_id', $value['language_id'])->update($value);
                
            } else {
                WelcomeMessageTranslation::insert($value);
            }
        }

        // Update welcome message section (Must be triggered after translation update to trigger the update event for cache clear)
        $welcome_message->update($data);

        return new WelcomeMessageResource($welcome_message);
    }
}
