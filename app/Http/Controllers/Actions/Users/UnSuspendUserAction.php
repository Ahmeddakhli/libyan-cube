<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;
use App\Models\Group;
use File, Config;
use App\Http\Helpers\Utilities;
use Illuminate\Http\Request;
use App, Lang;
use Carbon\Carbon;

class UnSuspendUserAction
{
    public function __construct()
    {
        //
    }

    public function execute($id, Request $request) : User
    {
        // Get the user
        $user = User::find($id);

        // Un suspend the user
        $user->is_suspended = 0;
        $user->save();

        return $user;
    }
}
