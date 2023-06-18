<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\TopAgent;
use Cache;
use LaravelLocalization;

class TopAgentEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(TopAgent $top_agent)
    {
        // Clearing top_agent
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_top_agents_'.$key);
        }
    }

    public function topAgentCreated(TopAgent $top_agent)
    {
        $this->clearCaches($top_agent);
    }

    public function topAgentUpdated(TopAgent $top_agent)
    {
        $this->clearCaches($top_agent);
    }

    public function topAgentSaved(TopAgent $top_agent)
    {
        $this->clearCaches($top_agent);
    }

    public function topAgentDeleted(TopAgent $top_agent)
    {
        $this->clearCaches($top_agent);
    }

    public function topAgentRestored(TopAgent $top_agent)
    {
        $this->clearCaches($top_agent);
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
