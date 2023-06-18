<?php

namespace Modules\Blog\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Blog\BlogCategoryTranslation;
use Modules\Blog\BlogCategory;
use Cache;

class BlogCategoryTranslationEvents
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

    private function clearCaches(BlogCategoryTranslation $blog_category_translation)
    {
        // Clearing blog category
        $blog_category = BlogCategory::find($blog_category_translation->blog_id);
        Cache::forget('blog_category'.$blog_category->id.'_value_'.'en');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('blog_category'.$blog_category->id.'_value_'.$key);
        }
    }

    public function blogCategoryTranslationCreated(BlogCategoryTranslation $blog_category_translation)
    {
        $this->clearCaches($blog_category_translation);
    }

    public function blogCategoryTranslationUpdated(BlogCategoryTranslation $blog_category_translation)
    {
        $this->clearCaches($blog_category_translation);
    }

    public function blogCategoryTranslationSaved(BlogCategoryTranslation $blog_category_translation)
    {
        $this->clearCaches($blog_category_translation);
    }

    public function blogCategoryTranslationDeleted(BlogCategoryTranslation $blog_category_translation)
    {
        $this->clearCaches($blog_category_translation);
    }

    public function blogCategoryTranslationRestored(BlogCategoryTranslation $blog_category_translation)
    {
        $this->clearCaches($blog_category_translation);
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
