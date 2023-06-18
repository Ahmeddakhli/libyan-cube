<?php

namespace Modules\Careers\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Careers\Career;
use Cache;
use LaravelLocalization;

class CareerEvents
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

    private function clearCaches(Career $career)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('careers_'.$career->id.'_value_'.'default');
        Cache::forget('careers_'.$career->id.'_description_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('careers_'.$career->id.'_value_'.$key);
            Cache::forget('careers_'.$career->id.'_description_'.$key);
            Cache::forget('careers_'.$career->id.'_meta_title_'.$key);
            Cache::forget('careers_'.$career->id.'_meta_description_'.$key);
        }
    }

    public function careerCreated(Career $career)
    {
        $this->clearCaches($career);
    }

    public function careerUpdated(Career $career)
    {
        $this->clearCaches($career);
    }

    public function careerSaved(Career $career)
    {
        $this->clearCaches($career);
    }

    public function careerDeleted(Career $career)
    {
        $this->clearCaches($career);
    }

    public function careerRestored(Career $career)
    {
        $this->clearCaches($career);
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
