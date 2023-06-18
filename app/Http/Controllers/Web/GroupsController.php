<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\CreateGroupRequest;
use App\Http\Requests\Groups\UpdateGroupRequest;
use App\Http\Requests\Groups\UpdateGroupPermissionsRequest;
use App\Http\Requests\Groups\DeleteGroupRequest;
use App\Http\Controllers\Actions\Groups\CreateGroupAction;
use App\Http\Controllers\Actions\Groups\UpdateGroupAction;
use App\Http\Controllers\Actions\Groups\UpdateGroupPermissionsAction;
use App\Http\Controllers\Actions\Groups\DeleteGroupAction;
use App\Http\Controllers\Actions\Groups\AllGroupsAction;
use App\Http\Controllers\Actions\Groups\SearchGroupsAction;
use App\Http\Controllers\Actions\Permissions\AllPermissionsAction;
use App\Http\Controllers\Actions\Users\AllUsersAction;
use App\Http\Resources\GroupResource;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Models\Group;
use Yajra\Datatables\Datatables;
use Lang;
use stdClass;

class GroupsController extends Controller
{
    /**
     * Store group
     *
     * @param  [integer] parent_id
     * @param  [string] name
     * @param  [string] slug
     * @param  [string] description
     * @param  [integer] permissions_group_id
     * @param  [array] users
     * @return [json] ServiceResponse object
     */
    public function store(CreateGroupRequest $request, CreateGroupAction $action)
    {
        // Store the group
        $group = $action->execute($request->except(['permissions_group_id', 'users']), $request->input('permissions_group_id'), $request->input('users'));

        // Transform the group
        $group = json_decode(json_encode(new GroupResource($group)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Group created successfully';
        $resp->status = true;
        $resp->data = $group;
        return response()->json($resp, 200);
    }

    /**
     * Update group
     *
     * @param  [integer] id
     * @param  [integer] parent_id
     * @param  [string] name
     * @param  [string] slug
     * @param  [string] description
     * @param  [integer] permissions_group_id
     * @param  [array] users
     * @return [json] ServiceResponse object
     */
    public function update(UpdateGroupRequest $request, UpdateGroupAction $action)
    {
        // Update the group
        $group = $action->execute($request->input('id'), $request->except(['id', 'permissions_group_id', 'users']), $request->input('permissions_group_id'), $request->input('users'));

        // Transform the group
        $group = json_decode(json_encode(new GroupResource($group)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Group updated successfully';
        $resp->status = true;
        $resp->data = $group;
        return response()->json($resp, 200);
    }

    /**
     * Delete group
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteGroupRequest $request, DeleteGroupAction $action)
    {
        // Delete the group
        $response = $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = $response ? 'Group delete successfully' : 'You must detach/delete the users/sub-groups first';
        $resp->status = $response ? true : false;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Update group permissions
     *
     * @param  [integer] id
     * @param  [array] permissions
     * @return [json] ServiceResponse object
     */
    public function updateGroupPermissions(UpdateGroupPermissionsRequest $request, UpdateGroupPermissionsAction $action)
    {
        // Auth user
        $user = Auth::user();

        // Update the group permissions
        $group = $action->execute($user, $request->input('id'), $request->input('permissions'));

        // Transform the group
        $group = json_decode(json_encode(new GroupResource($group)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Group permissions updated successfully';
        $resp->status = true;
        $resp->data = $group;
        return response()->json($resp, 200);
    }

    /**
     * Get groups
     *
     * @return [json] ServiceResponse object
     */
    public function all(Request $request, AllGroupsAction $action)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Transform the groups
        $groups = json_decode(json_encode(GroupResource::collection($groups)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Groups retrieved successfully';
        $resp->status = true;
        $resp->data = $groups;
        return response()->json($resp, 200);
    }

    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the groups
            $action = new SearchGroupsAction;
            $groups = $action->execute($auth_user, $request);

            // foreach ($groups as $group) {
            //     $group->load('parent');
            // }

            return Datatables::of($groups)->make(true);
        } else {        
            // Get the users
            $action = new AllUsersAction;
            // $users = $action->execute($auth_user);
            $users = $action->execute($auth_user)->get();

            // Get the groups
            $action = new AllGroupsAction;
            $groups = $action->execute($auth_user)->get();

            if($request->ajax()):
                // Load Partial
                return view('dashboard.pages.groups.index-partial', compact('users', 'groups'));
            else:
                // Load with Full Layout
                return view('dashboard.pages.groups.index', compact('users', 'groups'));
            endif;
        }

    }

    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Transform the groups
        $groups = json_decode(json_encode(GroupResource::collection($groups)));

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        return view('dashboard.pages.groups.create', compact('groups', 'users'));
    }

    public function createModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Transform the groups
        $groups = json_decode(json_encode(GroupResource::collection($groups)));

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        return view('dashboard.pages.groups.modals.create', compact('groups'))->render();
    }

    public function updateGroupModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Get the requested group
        $group = $groups->filter(function($group) use ($id) {
            return $group->id == $id;
        })->first();

        // If group does not exist, return error div
        if (!$group) {
            $error = Lang::get('groups.group_not_found_or_you_are_not_authorized_to_edit_the_group');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        // Get the group users
        $group_users = $group->users->pluck('id')->toArray();

        return view('dashboard.pages.groups.modals.update', compact('groups', 'group', 'users', 'group_users'))->render();
    }

    public function updateGroupPermissionsModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Get the requested group
        $group = $groups->filter(function($group) use ($id) {
            return $group->id == $id;
        })->first();

        // If group does not exist, return error div
        if (!$group) {
            $error = Lang::get('groups.group_not_found_or_you_are_not_authorized_to_edit_the_group');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the permissions
        $action = new AllPermissionsAction;
        $permissions = $action->execute();
        $permissions = $permissions->filter(function($permission) {
            return !$permission->parent_id;
        });

        return view('dashboard.pages.groups.modals.update_permissions', compact('group', 'permissions'))->render();
    }
}
