<?php

namespace Modules\Settings\Http\Controllers\Actions\MainSliders;

use Modules\Settings\MainSlider;
use Modules\Settings\Http\Resources\MainSliders\MainSliderResource;
use Cache;
use App;

class GetMainSlidersAction
{
    public function execute()
    {
        return Cache::rememberForever('settings_module_main_sliders_'.App::getLocale(), function() {
            $main_sliders = MainSlider::with('translations')->get();

            // Transform the main_sliders
            $main_sliders = MainSliderResource::collection($main_sliders);

            return $main_sliders;
        });
    }
}
