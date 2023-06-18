<?php

namespace Modules\Settings\Http\Controllers\Actions\Branches;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Settings\Branch;
use Modules\Settings\Http\Resources\Branches\BranchResource;

class UpdateBranchAction
{
    function execute($id, $data)
    {
        // Find branch
        $branch = Branch::find($id);

        // Update branch
        $branch->update($data);

        // Return transformed response
        return new BranchResource($branch);
    }
}
