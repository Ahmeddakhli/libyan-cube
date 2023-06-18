<?php

namespace Modules\Settings\Http\Controllers\Actions\HowWorks;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\HowWork;
use Modules\Settings\HowWorkTranslation;
use Modules\Settings\Http\Resources\HowWorks\HowWorkResource;

class UpdateHowWorkAction
{
    function execute($id, $data, $translations = null)
    {
        // Find how work
        $how_work = HowWork::find($id);

        // Create\Update translations
        foreach ($translations as $translation) {
            $how_work_trans = HowWorkTranslation::where('how_work_id', $how_work->id)->where('language_id', $translation['language_id'])->first();

            $translation['how_work_id'] = $how_work->id;

            if ($how_work_trans) {
                HowWorkTranslation::where('how_work_id', $how_work->id)->where('language_id', $translation['language_id'])->update($translation);
            } else {
                HowWorkTranslation::insert($translation);
            }
        }

        // Update how work
        $how_work->update($data);

        // Return transformed response
        return new HowWorkResource($how_work);
    }
}
