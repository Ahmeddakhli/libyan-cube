<?php

namespace Modules\Compares\Http\Controllers\Actions;

use Modules\Compares\Compare;

class DeleteCompareAction
{
    public function execute($id)
    {
        // Find compare 
        $compare = Compare::find($id);

        $compare->delete();

        return null;
    }
}
