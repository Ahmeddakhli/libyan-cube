<?php

namespace Modules\Locations\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Locations\Location;
use Cache;
use Illuminate\Support\Facades\App;
use LaravelLocalization;

class LocationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(Location $location)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('locations_' . $location->id . '_location_second_title' . 'en');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached lists
            if ($location && $location->parent && $location->parent->parent && $location->parent->parent->parent && $location->parent->parent->parent->parent_id == Location::where('parent_id', null)->first()->id) {
                // Is area, then clear city areas cache
                Cache::forget('locations_module_city_' . $location->parent_id . '_areas_' . $key);
            } elseif ($location && $location->parent && $location->parent->parent && $location->parent->parent->parent_id == Location::where('parent_id', null)->first()->id) {

                // Is city, then clear city region cache
                Cache::forget('locations_module_region_' . $location->parent_id . '_cities_' . $key);
            } elseif ($location && $location->parent && $location->parent->parent_id == Location::where('parent_id', null)->first()->id) {

                // Is region, then clear country regions cache
                Cache::forget('locations_module_country_' . $location->parent_id . '_regions_' . $key);
            } elseif ($location && $location->parent_id == Location::where('parent_id', null)->first()->id) {

                // Is country, then clear countries cache
                Cache::forget('locations_module_countries_' . $key);
            }
            Cache::forget('locations_' . $location->id . '_location_' . $key);
            Cache::forget('locations_' . $location->id . '_location_value_' . 'en');
            Cache::forget('locations_' . $location->id . '_location_default_value_' . 'en');

            Cache::forget('locations_' . $location->id . '_location_second_title' . $key);
        }
    }

    public function locationCreated(Location $location)
    {
        $this->clearCaches($location);
    }

    public function locationUpdated(Location $location)
    {
        $this->clearCaches($location);
    }

    public function locationSaved(Location $location)
    {
        $this->clearCaches($location);
    }

    public function locationDeleted(Location $location)
    {
        $this->clearCaches($location);
    }

    public function locationRestored(Location $location)
    {
        $this->clearCaches($location);
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
