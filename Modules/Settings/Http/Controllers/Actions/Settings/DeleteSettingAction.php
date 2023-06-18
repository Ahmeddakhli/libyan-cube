<?php

namespace Modules\Settings\Http\Controllers\Actions\Settings;

use Modules\Settings\Setting;

class DeleteSettingAction
{
    public function execute($id)
    {
        // Delete Setting 
        Setting::find($id)->delete();

        // return the response
        return null;
    }
}
