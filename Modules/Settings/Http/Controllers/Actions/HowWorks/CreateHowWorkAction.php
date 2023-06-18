<?php

namespace Modules\Settings\Http\Controllers\Actions\HowWorks;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\HowWork;
use Modules\Settings\HowWorkTranslation;
use Modules\Settings\Http\Resources\HowWorks\HowWorkResource;

class CreateHowWorkAction
{
    function execute($data, $translations = null)
    {
        // Create how work 
        $how_work = HowWork::create($data);

        // Create trianslations  
        foreach ($translations as $translation) {
            $translation['how_work_id'] = $how_work->id;

            HowWorkTranslation::insert($translation);
        }

        // update for cache translations
        $how_work->update();

        // Return transformed response
        return new HowWorkResource(HowWork::find($how_work->id));
    }
}
