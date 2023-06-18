<?php

namespace Modules\Blog\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Blog\BlogCategory;
use Cache;
use LaravelLocalization;

class BlogCategoryEvents
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

    private function clearCaches(BlogCategory $blog_category)
    {
        Cache::forget('blog_category'.$blog_category->id.'_value_'.'en');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('blog_category'.$blog_category->id.'_value_'.$key);
        }
    }

    public function blogCategoryCreated(BlogCategory $blog_category)
    {
        $this->clearCaches($blog_category);
    }

    public function blogCategoryUpdated(BlogCategory $blog_category)
    {
        $this->clearCaches($blog_category);
    }

    public function blogCategorySaved(BlogCategory $blog_category)
    {
        $this->clearCaches($blog_category);
    }

    public function blogCategoryDeleted(BlogCategory $blog_category)
    {
        $this->clearCaches($blog_category);
    }

    public function blogCategoryRestored(BlogCategory $blog_category)
    {
        $this->clearCaches($blog_category);
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
