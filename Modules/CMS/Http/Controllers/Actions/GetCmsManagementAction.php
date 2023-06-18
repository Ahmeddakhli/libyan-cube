<?php

namespace Modules\CMS\Http\Controllers\Actions;

use Modules\CMS\CmsManagement;
use Modules\CMS\Http\Resources\CmsManagementResource;
use Cache;
use App;

class GetCmsManagementAction
{
    public function execute($type = null)
    {
        // Get cms management
        $cms_managements = new CmsManagement();

        if ($type) {
            $cms_managements = $cms_managements->where('type', $type);
        }

        $cms_managements = $cms_managements->get();
        // Transform the cms_managements
        $cms_managements = CmsManagementResource::collection($cms_managements);

        return $cms_managements;
    }
}
