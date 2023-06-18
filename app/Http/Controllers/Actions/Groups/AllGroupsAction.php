<?php

namespace App\Http\Controllers\Actions\Groups;

use App\Models\Group;
use Cache;
use App\User;

class AllGroupsAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $user)
    {
        $auth_user_group = Group::find($user->group_id);

        // return $auth_user_group->getChildren();
        return $auth_user_group;
    }
}