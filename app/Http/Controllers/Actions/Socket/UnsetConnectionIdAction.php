<?php

namespace App\Http\Controllers\Actions\Socket;

use App\User;
use Carbon\Carbon;

class UnsetConnectionIdAction
{
    public function __construct()
    {
        //
    }

    public function execute($data) : User
    {
        // Unset the user connection_id
        $user = User::where('connection_id', $data['connection_id'])->first();
        $user->connection_id = null;
        $user->save();

        return $user;
    }
}
