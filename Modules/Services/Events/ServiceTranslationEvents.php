<?php

namespace Modules\Services\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Services\ServiceTranslation;
use Modules\Services\Service;
use Cache;

class ServiceTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function clearCaches(ServiceTranslation $service_translation)
    {
        // Clearing service
        $service = Service::find($service_translation->service_id);
        Cache::forget('service_'.$service->id.'_value_'.'default');
        Cache::forget('service_'.$service->id.'_description_'.'default');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('service_'.$service->id.'_value_'.$key);
        }
    }

    public function serviceTranslationCreated(ServiceTranslation $service_translation)
    {
        $this->clearCaches($service_translation);
    }

    public function serviceTranslationUpdated(ServiceTranslation $service_translation)
    {
        $this->clearCaches($service_translation);
    }

    public function serviceTranslationSaved(ServiceTranslation $service_translation)
    {
        $this->clearCaches($service_translation);
    }

    public function serviceTranslationDeleted(ServiceTranslation $service_translation)
    {
        $this->clearCaches($service_translation);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
