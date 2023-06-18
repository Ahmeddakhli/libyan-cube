<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;
use DB;
use Carbon\Carbon;

class DeleteIProjectAction
{
    public function execute($id)
    {
        // Get the i_project
        $iproject = IProject::find($id);

        $iproject->delete();

        return null;
    }
}
