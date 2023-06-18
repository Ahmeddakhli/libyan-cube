<?php

namespace Modules\Dashboard\Http\Controllers\Actions;

use App\User;

class GetActiveUsersCountAction
{
    public function execute()
    {
        // Get Count Users Active 
        $users_active = User::count();

        return $users_active;
    }
}
