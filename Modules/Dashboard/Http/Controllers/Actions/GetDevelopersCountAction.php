<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use Modules\Inventory\IDeveloper;

class GetDevelopersCountAction
{
    public function execute()
    {
        // Get Count Developers
        $developers = IDeveloper::count();

        return $developers;
    }
}
