<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IView;
use Cache;
use LaravelLocalization;

class IViewEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IView $i_view)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_views
            Cache::forget('inventory_module_views_' . $key);

            Cache::forget('i_view_' . $i_view->id . '_view_' . $key);
        }
    }

    public function iViewCreated(IView $i_view)
    {
        $this->clearCaches($i_view);
    }

    public function iViewUpdated(IView $i_view)
    {
        $this->clearCaches($i_view);
    }

    public function iViewSaved(IView $i_view)
    {
        $this->clearCaches($i_view);
    }

    public function iViewDeleted(IView $i_view)
    {
        $this->clearCaches($i_view);
    }

    public function iViewRestored(IView $i_view)
    {
        $this->clearCaches($i_view);
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
