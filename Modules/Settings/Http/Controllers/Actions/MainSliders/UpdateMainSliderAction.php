<?php

namespace Modules\Settings\Http\Controllers\Actions\MainSliders;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\MainSlider;
use Modules\Settings\MainSliderTranslation;
use Modules\Settings\Http\Resources\MainSliders\MainSliderResource;

class UpdateMainSliderAction
{
    function execute($id, $data, $translations = null)
    {
        // Find main slider
        $main_slider = MainSlider::find($id);

        // Create\Update translations
        foreach ($translations as $translation) {
            $main_slider_trans = MainSliderTranslation::where('main_slider_id', $main_slider->id)->where('language_id', $translation['language_id'])->first();

            $translation['main_slider_id'] = $main_slider->id;

            if ($main_slider_trans) {
                MainSliderTranslation::where('main_slider_id', $main_slider->id)->where('language_id', $translation['language_id'])->update($translation);
            } else {
                MainSliderTranslation::insert($translation);
            }
        }

        // Update main slider
        $main_slider->update($data);

        // Return transformed response
        return new MainSliderResource($main_slider);
    }
}
