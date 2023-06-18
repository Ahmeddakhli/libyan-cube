<?php

namespace App\Http\Controllers\Api\V1;

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
use App\Http\Resources\GroupResource;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Models\Group;

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
        $group = $action->execute($request->except(['permissions_group_id']), $request->input('permissions_group_id'), $request->input('users'));

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
        $user = $request->user();

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
        $user = $request->user();

        // Get the groups
        // $groups = $action->execute($user);
        $groups = $action->execute($user)->get();

        // Transform the groups
        $groups = json_decode(json_encode(GroupResource::collection($groups)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Groups retrieved successfully';
        $resp->status = true;
        $resp->data = $groups;
        return response()->json($resp, 200);
    }


}
