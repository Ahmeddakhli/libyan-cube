<?php

namespace App\Http\Controllers\Actions\Permissions;

use App\Models\Permission;
use Cache;

class AllPermissionsAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        $permissions = Permission::all();

        return $permissions;
    }
}