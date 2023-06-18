<?php

namespace Modules\Settings\Http\Controllers\Actions\Branches;

use Illuminate\Support\Facades\Lang;
use Modules\Settings\Branch;
use Modules\Settings\Http\Resources\Branches\BranchResource;

class CreateBranchAction
{
    function execute($data)
    {
        // Create branch
        $branch = Branch::create($data);

        // Return transfromed response
        return new BranchResource($branch);
    }
}
