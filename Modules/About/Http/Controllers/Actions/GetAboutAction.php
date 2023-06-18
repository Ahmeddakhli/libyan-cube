<?php

namespace Modules\About\Http\Controllers\Actions;

use Modules\About\About;
use Modules\About\Http\Resources\AboutResource;
use Cache;
use App;

class GetAboutAction
{
    public function execute()
    {
        return Cache::rememberForever('about_module_about_sections_'.App::getLocale(), function() {
	        // Get about_sections
	        $about_sections = About::all();

            // Transform the about_sections
            $about_sections = AboutResource::collection($about_sections);

            return $about_sections;
        });
    }
}
