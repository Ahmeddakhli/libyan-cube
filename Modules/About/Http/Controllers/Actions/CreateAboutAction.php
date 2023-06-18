<?php

namespace Modules\About\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\About\About;
use Modules\About\AboutTranslation;
use Modules\About\Http\Resources\AboutResource;

class CreateAboutAction
{
    function execute($data, $translations = null)
    {
        if (isset($data['image']) && is_file($data['image'])) {
            $data['image'] = $data['image']->store('/about', 'public');
        }
        $about = About::create($data);
        foreach ($translations as $value) {
            AboutTranslation::insert([
                'language_id' => $value['language_id'],
                'title' => $value['title'],
                'description' => $value['description'],
                'about_id' => $about->id
            ]);
        }

        // Load about translations
        $about->update();

        return new AboutResource($about);
    }
}
