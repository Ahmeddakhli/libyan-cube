<?php

namespace Modules\About\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\About\About;
use Modules\About\AboutTranslation;
use Modules\About\Http\Resources\AboutResource;

class UpdateAboutAction
{
    function execute($id, $data, $translations = null)
    {
        // Get about section
        if (isset($data['image']) && is_file($data['image'])) {
            $data['image'] = $data['image']->store('/about', 'public');
        }

        if (isset($data['delete_image']) && $data['delete_image']) {
            $data['image'] = null;
        }
        
        $about_section = About::find($id);

        foreach ($translations as $value) {
            $about_section_translation = AboutTranslation::where('about_id', $about_section->id)->where('language_id', $value['language_id'])->first();
            $value['about_id'] = $about_section->id;
            if ($about_section_translation) {
                AboutTranslation::where('about_id', $about_section->id)->where('language_id', $value['language_id'])->update($value);
            } else {
                AboutTranslation::insert($value);
            }
        }

        // Update about section (Must be triggered after translation update to trigger the update event for cache clear)
        $about_section->update($data);

        return new AboutResource($about_section);
    }
}
