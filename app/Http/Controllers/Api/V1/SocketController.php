<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use App\Http\Requests\Socket\SetConnectionIdRequest;
use App\Http\Requests\Socket\UnsetConnectionIdRequest;
use App\Http\Controllers\Actions\Socket\SetConnectionIdAction;
use App\Http\Controllers\Actions\Socket\UnsetConnectionIdAction;
use App\Http\Resources\UserResource;

class SocketController extends Controller
{
    /**
     * Set the user connection id
     *
     * @param  [integer] id
     * @param  [string] connection_id
     * @return [json] ServiceResponse object
     */
    public function setConnectionId(SetConnectionIdRequest $request, SetConnectionIdAction $action)
    {
        // Set the user connection id
        $user = $action->execute($request->all());

        // Get the online parents
        $parents = $user->getParents();
        $parents = $parents->filter(function($parent) {
            return $parent->connection_id != null;
        });
        // Get the connections ids of the online parents
        $connection_ids = $parents->pluck('connection_id')->toArray();

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User connection id set successfully';
        $resp->status = true;
        $resp->data = ['user' => $user, 'connection_ids' => $connection_ids];
        return response()->json($resp, 200);
    }

    /**
     * Unset the user connection id
     *
     * @param  [string] connection_id
     * @return [json] ServiceResponse object
     */
    public function unsetConnectionId(UnsetConnectionIdRequest $request, UnsetConnectionIdAction $action)
    {
        // Unset the user connection id
        $user = $action->execute($request->all());

        // Get the online parents
        $parents = $user->getParents();
        $parents = $parents->filter(function($parent) {
            return $parent->connection_id != null;
        });
        // Get the connections ids of the online parents
        $connection_ids = $parents->pluck('connection_id')->toArray();

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User connection id unset successfully';
        $resp->status = true;
        $resp->data = ['user' => $user, 'connection_ids' => $connection_ids];
        return response()->json($resp, 200);
    }
}
