<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IViewTranslation;
use Modules\Inventory\IView;
use Cache;
use LaravelLocalization;

class IViewTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IViewTranslation $i_view_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_view
        $i_view = IView::find($i_view_translation->i_view_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_view
            Cache::forget('inventory_module_views_' . $key);

            Cache::forget('i_view_' . $i_view->id . '_view_' . $key);
        }
    }

    public function iViewTranslationCreated(IViewTranslation $i_view_translation)
    {
        $this->clearCaches($i_view_translation);
    }

    public function iViewTranslationUpdated(IViewTranslation $i_view_translation)
    {
        $this->clearCaches($i_view_translation);
    }

    public function iViewTranslationSaved(IViewTranslation $i_view_translation)
    {
        $this->clearCaches($i_view_translation);
    }

    public function iViewTranslationDeleted(IViewTranslation $i_view_translation)
    {
        $this->clearCaches($i_view_translation);
    }

    public function iViewTranslationRestored(IViewTranslation $i_view_translation)
    {
        $this->clearCaches($i_view_translation);
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
