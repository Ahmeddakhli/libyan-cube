<?php

namespace Modules\Blog\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Blog\Blog;
use Cache;
use LaravelLocalization;

class BlogEvents
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

    private function clearCaches(Blog $blog)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('blog_'.$blog->id.'_value_'.'default');
        Cache::forget('blog_'.$blog->id.'_description_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('blog_'.$blog->id.'_value_'.$key);
            Cache::forget('blog_'.$blog->id.'_description_'.$key);
            Cache::forget('blog_'.$blog->id.'_meta_title_'.$key);
            Cache::forget('blog_'.$blog->id.'_meta_description_'.$key);
        }
    }

    public function blogCreated(Blog $blog)
    {
        $this->clearCaches($blog);
    }

    public function blogUpdated(Blog $blog)
    {
        $this->clearCaches($blog);
    }

    public function blogSaved(Blog $blog)
    {
        $this->clearCaches($blog);
    }

    public function blogDeleted(Blog $blog)
    {
        $this->clearCaches($blog);
    }

    public function blogRestored(Blog $blog)
    {
        $this->clearCaches($blog);
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
