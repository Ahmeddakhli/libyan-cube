<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IProjectTranslation;
use Modules\Inventory\IProject;
use Cache;
use LaravelLocalization;

class IProjectTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IProjectTranslation $i_project_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clear cached i_projects
        Cache::forget('inventory_module_projects');

        // Clearing i_project
        $i_project = IProject::find($i_project_translation->i_project_id);
        Cache::forget('i_project_' . $i_project->id . '_project_' . 'default');
        Cache::forget('i_project_' . $i_project->id . '_second_title_' . 'default');
        Cache::forget('i_project_' . $i_project->id . '_description_' . 'default');
        Cache::forget('i_project_' . $i_project->id . '_landing_description_' . 'default');
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('i_project_' . $i_project->id . '_project_' . $key);
            Cache::forget('i_project_' . $i_project->id . '_second_title_' . $key);
            Cache::forget('i_project_' . $i_project->id . '_description_' . $key);
            Cache::forget('i_project_' . $i_project->id . '_landing_description_' . $key);
            Cache::forget('i_project_' . $i_project->id . '_meta_title_' . $key);
            Cache::forget('i_project_' . $i_project->id . '_meta_description_' . $key);
        }
    }

    public function iProjectTranslationCreated(IProjectTranslation $i_project_translation)
    {
        $this->clearCaches($i_project_translation);
    }

    public function iProjectTranslationUpdated(IProjectTranslation $i_project_translation)
    {
        $this->clearCaches($i_project_translation);
    }

    public function iProjectTranslationSaved(IProjectTranslation $i_project_translation)
    {
        $this->clearCaches($i_project_translation);
    }

    public function iProjectTranslationDeleted(IProjectTranslation $i_project_translation)
    {
        $this->clearCaches($i_project_translation);
    }

    public function iProjectTranslationRestored(IProjectTranslation $i_project_translation)
    {
        $this->clearCaches($i_project_translation);
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
