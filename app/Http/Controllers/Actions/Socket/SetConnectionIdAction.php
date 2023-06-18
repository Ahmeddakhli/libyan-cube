<?php

namespace App\Http\Controllers\Actions\Socket;

use App\User;
use Carbon\Carbon;

class SetConnectionIdAction
{
    public function __construct()
    {
        //
    }

    public function execute($data) : User
    {
        // Set the user connection_id
        $user = User::find($data['id']);
        $user->connection_id = $data['connection_id'];
        $user->save();

        return $user;
    }
}
