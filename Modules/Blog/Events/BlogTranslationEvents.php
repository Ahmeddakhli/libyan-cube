<?php

namespace Modules\Blog\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Blog\BlogTranslation;
use Modules\Blog\Blog;
use Cache;

class BlogTranslationEvents
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

    private function clearCaches(BlogTranslation $blog_translation)
    {
        // Clearing blog
        $blog = Blog::find($blog_translation->blog_id);

        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('blog_'.$blog->id.'_value_'.$key);
            Cache::forget('blog_'.$blog->id.'_description_'.$key);
            Cache::forget('blog_'.$blog->id.'_meta_title_'.$key);
            Cache::forget('blog_'.$blog->id.'_meta_description_'.$key);
        }
    }

    public function blogTranslationCreated(BlogTranslation $blog_translation)
    {
        $this->clearCaches($blog_translation);
    }

    public function blogTranslationUpdated(BlogTranslation $blog_translation)
    {
        $this->clearCaches($blog_translation);
    }

    public function blogTranslationSaved(BlogTranslation $blog_translation)
    {
        $this->clearCaches($blog_translation);
    }

    public function blogTranslationDeleted(BlogTranslation $blog_translation)
    {
        $this->clearCaches($blog_translation);
    }

    public function blogTranslationRestored(BlogTranslation $blog_translation)
    {
        $this->clearCaches($blog_translation);
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
