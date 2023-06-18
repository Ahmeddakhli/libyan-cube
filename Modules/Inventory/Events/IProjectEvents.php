<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IProject;
use Cache;
use LaravelLocalization;

class IProjectEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IProject $iproject)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clear cached i_projects
        Cache::forget('inventory_module_projects');
        Cache::forget('i_project_' . $iproject->id . '_project_' . 'default');
        Cache::forget('i_project_' . $iproject->id . '_second_title_' . 'default');
        Cache::forget('i_project_' . $iproject->id . '_description_' . 'default');
        Cache::forget('i_project_' . $iproject->id . '_landing_description_' . 'default');

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('i_project_' . $iproject->id . '_project_' . $key);
            Cache::forget('i_project_' . $iproject->id . '_second_title_' . $key);
            Cache::forget('i_project_' . $iproject->id . '_description_' . $key);
            Cache::forget('i_project_' . $iproject->id . '_landing_description_' . $key);
            Cache::forget('i_project_' . $iproject->id . '_meta_title_' . $key);
            Cache::forget('i_project_' . $iproject->id . '_meta_description_' . $key);
        }
    }

    public function iProjectCreated(IProject $iproject)
    {
        $this->clearCaches($iproject);
    }

    public function iProjectUpdated(IProject $iproject)
    {
        $this->clearCaches($iproject);
    }

    public function iProjectSaved(IProject $iproject)
    {
        $this->clearCaches($iproject);
    }

    public function iProjectDeleted(IProject $iproject)
    {
        $this->clearCaches($iproject);
    }

    public function iProjectRestored(IProject $iproject)
    {
        $this->clearCaches($iproject);
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
