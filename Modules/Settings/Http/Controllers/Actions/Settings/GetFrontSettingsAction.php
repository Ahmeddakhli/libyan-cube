<?php

namespace Modules\Settings\Http\Controllers\Actions\Settings;

use Modules\Settings\Setting;
use Modules\Settings\Http\Resources\Settings\SettingResource;
use Cache;
use App;

class GetFrontSettingsAction
{
    public function execute()
    {
        $settings = Setting::all();

        // Transform the settings
        $settings = SettingResource::collection($settings)->groupBy('type');
        
        return $settings;
    }
}
