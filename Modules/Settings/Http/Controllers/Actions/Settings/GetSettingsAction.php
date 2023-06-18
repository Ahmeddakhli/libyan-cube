<?php

namespace Modules\Settings\Http\Controllers\Actions\Settings;

use Modules\Settings\Setting;
use Modules\Settings\Http\Resources\Settings\SettingResource;
use Cache;
use App;

class GetSettingsAction
{
    public function execute()
    {
        return Cache::rememberForever('settings_module_settings_'.App::getLocale(), function() {
            $settings = Setting::all();

            // Transform the settings
            $settings = SettingResource::collection($settings);

            return $settings;
        });
    }
}
