<?php

namespace Modules\Compares\Http\Controllers\Actions;

use Modules\Compares\Compare;
use Modules\Compares\Http\Resources\CompareResource;

class UpdateCompareAction
{
    public function execute($id, $data)
    {
        // Find compare 
        $compares = Compare::find($id);

        $compares->update($data);

        return new CompareResource($compares);
    }
}
