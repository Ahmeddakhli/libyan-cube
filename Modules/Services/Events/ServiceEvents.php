<?php

namespace Modules\Services\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Services\Service;
use Cache;
use LaravelLocalization;

class ServiceEvents
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

    private function clearCaches(Service $service)
    {
        Cache::forget('service_'.$service->id.'_value_'.'default');
        Cache::forget('service_'.$service->id.'_description_'.'default');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('service_'.$service->id.'_value_'.$key);
        }
    }

    public function serviceCreated(Service $service)
    {
        $this->clearCaches($service);
    }

    public function serviceUpdated(Service $service)
    {
        $this->clearCaches($service);
    }

    public function serviceSaved(Service $service)
    {
        $this->clearCaches($service);
    }

    public function serviceDeleted(Service $service)
    {
        $this->clearCaches($service);
    }

    public function serviceRestored(Service $service)
    {
        $this->clearCaches($service);
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
