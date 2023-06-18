<?php

namespace Modules\CMS\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\CMS\CmsManagement;
use Cache;
use App, Auth;
use LaravelLocalization;

class CmsManagementEvents
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

    private function clearCaches(CmsManagement $cms_management)
    {
        Cache::forget('cms_management_'.$cms_management->id.'_default_title');
        Cache::forget('cms_management_'.$cms_management->id.'_default_description');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('cms_managements_'.$key);
            Cache::forget('cms_management_'.$cms_management->id.'_title_'.$key);
            Cache::forget('cms_management_'.$cms_management->id.'_description_'.$key);
        }
    }

    public function cmsManagementCreated(CmsManagement $cms_management)
    {
        $this->clearCaches($cms_management);
    }

    public function cmsManagementUpdated(CmsManagement $cms_management)
    {
        $this->clearCaches($cms_management);
    }

    public function cmsManagementSaved(CmsManagement $cms_management)
    {
        $this->clearCaches($cms_management);
    }

    public function cmsManagementDeleted(CmsManagement $cms_management)
    {
        $this->clearCaches($cms_management);
    }

    public function cmsManagementRestored(CmsManagement $cms_management)
    {
        $this->clearCaches($cms_management);
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
