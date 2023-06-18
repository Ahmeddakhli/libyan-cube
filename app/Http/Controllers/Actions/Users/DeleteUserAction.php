<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;

class DeleteUserAction
{
    public function __construct()
    {
        //
    }

    public function execute($id)
    {
        // Delete the user
        $user = User::find($id);
        $user->delete();

        return null;
    }
}