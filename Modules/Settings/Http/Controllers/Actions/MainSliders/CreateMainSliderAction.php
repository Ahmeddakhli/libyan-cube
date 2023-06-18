<?php

namespace Modules\Settings\Http\Controllers\Actions\MainSliders;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\MainSlider;
use Modules\Settings\MainSliderTranslation;
use Modules\Settings\Http\Resources\MainSliders\MainSliderResource;

class CreateMainSliderAction
{
    function execute($data, $translations = null)
    {
        // Create main slider 
        $main_slider = MainSlider::create($data);

        // Create trianslations  
        foreach ($translations as $translation) {
            $translation['main_slider_id'] = $main_slider->id;

            MainSliderTranslation::insert($translation);
        }

        // update for cache translations
        $main_slider->update();

        // Return transformed response
        return new MainSliderResource(MainSlider::find($main_slider->id));
    }
}
