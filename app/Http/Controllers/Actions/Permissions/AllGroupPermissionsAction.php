<?php

namespace App\Http\Controllers\Actions\Permissions;

use App\Models\Permission;
use App\Models\Group;
use Cache;

class AllGroupPermissionsAction
{
    public function __construct()
    {
        //
    }

    public function execute(Group $group)
    {
        return $group->permissions;
    }
}