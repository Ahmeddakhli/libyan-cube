<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use DB;
use Carbon\Carbon;

class PublishIProjectAction
{
    public function execute($id)
    {
        // Get the i_project
        $iproject = IProject::find($id);

        $iproject->update([
            'is_published' => $iproject->is_published ? 0 : 1
        ]);

        return null;
    }
}
