<?php

namespace Modules\Tags\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Tags\Tag;
use Cache;

class TagEvents
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

    private function clearCaches(Tag $tag)
    {
        // Clear cached tags
        Cache::forget('tags_module_tags');
    }

    public function tagCreated(Tag $tag)
    {
        $this->clearCaches($tag);
    }

    public function tagUpdated(Tag $tag)
    {
        $this->clearCaches($tag);
    }

    public function tagSaved(Tag $tag)
    {
        $this->clearCaches($tag);
    }

    public function tagDeleted(Tag $tag)
    {
        $this->clearCaches($tag);
    }

    public function tagRestored(Tag $tag)
    {
        $this->clearCaches($tag);
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
