<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;
use App\Models\Group;
use Cache;

class GetUsersHaveEitherPermissionAction
{
    public function __construct()
    {
        //
    }

    public function execute($permissions = array())
    {
        $users = User::notSuspended()->get();
        $users_have_either_permission = array();

        foreach ($users as $user) {
            $user_has_either_permission = false;
            foreach ($permissions as $permission) {
                if ($user->hasPermission($permission)) {
                    $user_has_either_permission = true;
                    break;
                }
            }
            if ($user_has_either_permission) {
                unset($user->permissions);
                array_push($users_have_either_permission, $user);
            }
        }

        return $users_have_either_permission;
    }
}
