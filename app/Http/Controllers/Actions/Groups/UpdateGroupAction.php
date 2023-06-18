<?php

namespace App\Http\Controllers\Actions\Groups;

use App\Models\Group;
use App\User;

class UpdateGroupAction
{
	public function __construct()
	{
		//
	}

	public function execute($id, array $data, $permissions_group_id = null, $users = []) : Group
	{
		$data['slug'] = str_slug($data['name']);

        // Update the group
        $group = Group::find($id);
        $group->update($data);
        $group->save();

        // Updating the permissions
        if ($permissions_group_id) {
        	$permissions_group = Group::find($permissions_group_id);
        	if ($permissions_group) {
                // Clearing the old permissions from the group and the users of the group
                $users = $group->users;
                foreach ($users as $user) {
                    $user->permissions()->sync([]);

                    // Attaching the new permissions to the user
                    $user->permissions()->attach($permissions_group->permissions);
                    $user->save();
                }
                $group->permissions()->sync([]);

                // Attaching the new permissions to the group
		        $group->permissions()->attach($permissions_group->permissions);
                $group->save();
        	}
        }

        // Update users group_id
        if (!$users)  {
            $users = array();
        }
        $users = User::whereIn('id', $users)->get();
        foreach ($users as $user) {
            $user->group_id = $group->id;
            $user->save();

            // Update user permissions
            $user->permissions()->sync([]);
            $user->permissions()->attach($group->permissions);
            $user->save();
        }

        $group = Group::find($id); // To unload the permissions relation

        return $group;
	}
}
