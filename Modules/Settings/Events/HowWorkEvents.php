<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\HowWork;
use Cache;
use LaravelLocalization;

class HowWorkEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(HowWork $how_work)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('how_work_' . $how_work->id . '_default_value');
        Cache::forget('how_work_' . $how_work->id . '_default_description');

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_how_works_'.$key);
            Cache::forget('how_work_' . $how_work->id . '_value_' . $key);
            Cache::forget('how_work_' . $how_work->id . '_description_' . $key);
        }
    }

    public function howWorkCreated(HowWork $how_work)
    {
        $this->clearCaches($how_work);
    }

    public function howWorkUpdated(HowWork $how_work)
    {
        $this->clearCaches($how_work);
    }

    public function howWorkSaved(HowWork $how_work)
    {
        $this->clearCaches($how_work);
    }

    public function howWorkDeleted(HowWork $how_work)
    {
        $this->clearCaches($how_work);
    }

    public function howWorkRestored(HowWork $how_work)
    {
        $this->clearCaches($how_work);
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
