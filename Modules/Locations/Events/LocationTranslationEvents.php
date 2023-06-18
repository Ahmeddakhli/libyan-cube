<?php

namespace Modules\Locations\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Locations\LocationTranslation;
use Modules\Locations\Location;
use Cache;
use LaravelLocalization;

class LocationTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(LocationTranslation $location_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        $location = Location::where('id',$location_translation->location_id)->first();
        Cache::forget('locations_' . $location->id . '_location_second_title' . 'en');
        Cache::forget('locations_' . $location->id . '_location_value_' . 'en');
        Cache::forget('locations_' . $location->id . '_location_default_value_' . 'en');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached lists
            if ($location_translation && $location_translation->parent && $location_translation->parent->parent && $location_translation->parent->parent->parent && $location_translation->parent->parent->parent->parent_id == Location::where('parent_id', null)->first()->id) {
                // Is area, then clear city areas cache
                Cache::forget('locations_module_city_' . $location_translation->parent_id . '_areas_'.$key);
            } elseif ($location_translation->location && $location_translation->location->parent && $location_translation->location->parent->parent && $location_translation->location->parent->parent->parent_id == Location::where('parent_id', null)->first()->id) {
                // Is city, then clear city region cache
                Cache::forget('locations_module_region_' . $location_translation->location->parent_id . '_cities_'.$key);
            } elseif ($location_translation->location && $location_translation->location->parent && $location_translation->location->parent->parent_id == Location::where('parent_id', null)->first()->id) {

                // Is region, then clear country regions cache
                Cache::forget('locations_module_country_' . $location_translation->location->parent_id . '_regions_'.$key);
            } elseif ($location_translation->location && $location_translation->location->parent_id == Location::where('parent_id', null)->first()->id) {

                // Is country, then clear countries cache
                Cache::forget('locations_module_countries_'.$key);
                Cache::forget('locations_' . $location->id . '_location_' . $key);
            }
            Cache::forget('locations_' . $location->id . '_location_second_title' . $key);
        }
    }

    public function locationTranslationCreated(LocationTranslation $location_translation)
    {
        $this->clearCaches($location_translation);
    }

    public function locationTranslationUpdated(LocationTranslation $location_translation)
    {
        $this->clearCaches($location_translation);
    }

    public function locationTranslationSaved(LocationTranslation $location_translation)
    {
        $this->clearCaches($location_translation);
    }

    public function locationTranslationDeleted(LocationTranslation $location_translation)
    {
        $this->clearCaches($location_translation);
    }

    public function locationTranslationRestored(LocationTranslation $location_translation)
    {
        $this->clearCaches($location_translation);
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
