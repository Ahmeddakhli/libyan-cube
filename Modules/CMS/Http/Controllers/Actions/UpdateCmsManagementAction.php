<?php

namespace Modules\CMS\Http\Controllers\Actions;


use Modules\CMS\CmsManagement;
use Modules\CMS\CmsManagementTranslation;
use Modules\CMS\Http\Resources\CmsManagementResource;

class UpdateCmsManagementAction
{
    function execute($id, $data, $translations = null)
    {
        // Get cms management
        $cms_management = CmsManagement::find($id);

        // Delete previous trnaslations
        CmsManagementTranslation::where('cms_management_id', $cms_management->id)->delete();

        // Insert new translations
        foreach ($translations as $value) {
            $value['cms_management_id'] = $cms_management->id;
            CmsManagementTranslation::insert($value);
        }

        // Update cms management (Must be triggered after translation update to trigger the update event for cache clear)
        $cms_management->update($data);

        return new CmsManagementResource($cms_management);
    }
}
