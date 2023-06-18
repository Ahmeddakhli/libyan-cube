<?php

namespace Modules\Settings\Http\Controllers\Actions\Branches;

use Modules\Settings\Branch;

class DeleteBranchAction
{
    public function execute($id)
    {
        // Delete branch
        Branch::find($id)->delete();

        // Return response
        return null;
    }
}
