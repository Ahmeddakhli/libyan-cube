<?php

namespace App\Http\Controllers\Actions\Groups;

use App\User;
use App\Models\Group;
use App\Models\Permission;
use App\Models\GroupPermission;

class UpdateGroupPermissionsAction
{
	public function __construct()
	{
		//
	}

	public function execute(User $auth_user, $id, array $permissions) : Group
	{
        // Update the group permissions
        $group = Group::find($id);
        $users = $group->users;

        // Updating the group users permissions
        foreach ($users as $user) {
            $user->permissions()->sync([]);
            $user->permissions()->attach($permissions);
            $user->save();
        }

        // Updating the group permissions
        $group->permissions()->sync([]);
        $group->permissions()->attach($permissions);
        $group->save();

        // Append permissions parents
        foreach ($permissions as $permission) {
            $permission = Permission::find($permission)->parent_id;
            $group_permissions = $group->permissions->pluck('id')->toArray();
            if ($permission && !GroupPermission::where('group_id', $group->id)->where('permission_id', $permission)->first()) {
                $group->permissions()->attach($permission);
            }
        }

        $group = Group::find($id); // To unload the permissions relation

        // Log instance
        $activity = activity('group_permissions_log')
            ->performedOn($group)
            ->causedBy($auth_user)
            ->log(':causer.username updated the permissions of :subject.name');

        return $group;
	}
}