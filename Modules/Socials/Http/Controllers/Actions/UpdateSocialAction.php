<?php

namespace Modules\Socials\Http\Controllers\Actions;

use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Socials\Social;
use Modules\Socials\SocialTranslation;
use Modules\Socials\Http\Resources\SocialResource;

class UpdateSocialAction
{
    function execute($id, $data, $translations = null)
    {
        // Get social
        $social = Social::find($id);
        $updated_at = Carbon::now()->toDateTimeString();

        // Create\Update social translation 
        foreach ($translations as $value) {
            $socialTrans = SocialTranslation::where('social_id', $social->id)->where('language_id', $value['language_id'])->first();
            $value['social_id'] = $social->id;
            if ($socialTrans) {
                SocialTranslation::where('social_id', $social->id)->where('language_id', $value['language_id'])->update($value);
            } else {
                SocialTranslation::insert($value);
            }
        }

        // Update social
        $social->update([
            'is_featured' => isset($data['is_featured']) ? $data['is_featured'] : 0,
            'link' => $data['link'],
            'icon' => $data['icon'],
            'updated_at' => $updated_at,
        ]);

        // Return transformed response 
        return new SocialResource($social);
    }
}
