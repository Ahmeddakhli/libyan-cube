<?php

namespace Modules\CMS\Http\Controllers\Actions;

use Modules\CMS\CmsManagement;

class DeleteCmsManagementAction
{
    public function execute($id)
    {
        $cms_management = CmsManagement::find($id)->delete();
        return $cms_management;
    }
}
