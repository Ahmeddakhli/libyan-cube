<?php

namespace Modules\Settings\Http\Controllers\Actions\Settings;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\Setting;
use Modules\Settings\Http\Resources\Settings\SettingResource;

class CreateSettingAction
{
    function execute($data)
    {
        // Create Setting
        $setting = Setting::create($data);

        // return transformed response
        return new SettingResource($setting);
    }
}
