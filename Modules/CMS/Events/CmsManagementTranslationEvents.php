<?php

namespace Modules\CMS\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\CMS\CmsManagementTranslation;
use Modules\CMS\CmsManagement;
use Cache;

class CmsManagementTranslationEvents
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

    private function clearCaches(CmsManagementTranslation $cms_management_translation)
    {
        // Clearing cmsManagement
        $cms_management = CmsManagement::find($cms_management_translation->cms_management_id);
        Cache::forget('cms_management_'.$cms_management->id.'_default_title');
        Cache::forget('cms_management_'.$cms_management->id.'_default_description');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('cms_management_'.$cms_management->id.'_title_'.$key);
            Cache::forget('cms_management_'.$cms_management->id.'_description_'.$key);
        }
    }

    public function cmsManagementTranslationCreated(CmsManagementTranslation $cms_management_translation)
    {
        $this->clearCaches($cms_management_translation);
    }

    public function cmsManagementTranslationUpdated(CmsManagementTranslation $cms_management_translation)
    {
        $this->clearCaches($cms_management_translation);
    }

    public function cmsManagementTranslationSaved(CmsManagementTranslation $cms_management_translation)
    {
        $this->clearCaches($cms_management_translation);
    }

    public function cmsManagementTranslationDeleted(CmsManagementTranslation $cms_management_translation)
    {
        $this->clearCaches($cms_management_translation);
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
