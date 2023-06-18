<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;
use App\Models\Group;
use Cache;

class AllUsersAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $auth_user, $suspended = false)
    {
        // return $auth_user->getChildren();

        if ($suspended) {
	        return new User;
        } else {
	        return User::notSuspended();
        }
    }
}
