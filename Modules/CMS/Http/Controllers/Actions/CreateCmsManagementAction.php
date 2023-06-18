<?php

namespace Modules\CMS\Http\Controllers\Actions;

use Modules\CMS\CmsManagement;
use Modules\CMS\CmsManagementTranslation;
use Modules\CMS\Http\Resources\CmsManagementResource;

class CreateCmsManagementAction
{
    function execute($data, $translations = null)
    {
        $cms_management = CmsManagement::create($data);
        foreach ($translations as $value) {
            CmsManagementTranslation::insert([
                'language_id' => $value['language_id'],
                'title' => $value['title'],
                'description' => $value['description'],
                'cms_management_id' => $cms_management->id
            ]);
        }

        // Load CmsManagement translations
        return new CmsManagementResource(CmsManagement::find($cms_management->id));
    }
}
