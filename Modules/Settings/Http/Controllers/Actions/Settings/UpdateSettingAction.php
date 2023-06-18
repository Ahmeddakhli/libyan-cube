<?php

namespace Modules\Settings\Http\Controllers\Actions\Settings;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Settings\Setting;
use Modules\Settings\Http\Resources\Settings\SettingResource;

class UpdateSettingAction
{
    function execute($id, $data)
    {
        // Find setting
        $setting = Setting::find($id);
        
        if(!isset($data['enable_ar'])){
            $data['enable_ar'] = 0;
        }

        if(!isset($data['active_whatsapp_icon'])){
            $data['active_whatsapp_icon'] = 0;
        }
        
        if(!isset($data['active_messanger_icon'])){
            $data['active_messanger_icon'] = 0;
        }

        if(!isset($data['active_phone_icon'])){
            $data['active_phone_icon'] = 0;
        }
        // Update setting 
        $setting->update($data);

        // Return transformed response
        return new SettingResource($setting);
    }
}
