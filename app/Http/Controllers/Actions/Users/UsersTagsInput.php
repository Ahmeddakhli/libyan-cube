<?php

namespace App\Http\Controllers\Actions\Users;

use App\User; 

class UsersTagsInput
{
    public function __construct()
    {
        //
    }

    public function execute(array $data)
    {
        $needle = $data['needle'];
        if ($needle) {
            $users = User::where('full_name', 'LIKE', '%'.$needle.'%')
                ->orwhere('mobile_number', 'LIKE', '%'.$needle.'%')->take(50)->get();
        } else {
            $users = User::take(50)->get();
        }
        
        foreach ($users as $user) {
            
            $user->name = $user->full_name ? $user->full_name : '';
        }

        return $users;
    }
}