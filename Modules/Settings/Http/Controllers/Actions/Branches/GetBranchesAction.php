<?php

namespace Modules\Settings\Http\Controllers\Actions\Branches;

use Modules\Settings\Branch;
use Modules\Settings\Http\Resources\Branches\BranchResource;
use Cache;
use App;

class GetBranchesAction
{
    public function execute()
    {
        $branches = Branch::all();

        // Transform the branches
        $branches = BranchResource::collection($branches);

        return $branches;
    }
}
