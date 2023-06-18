<?php

namespace Modules\Messages\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Modules\Inventory\Http\Resources\IProjectMinimalResource;
use Modules\Inventory\Http\Resources\IUnitMinimalResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project' => $this->project ? new IProjectMinimalResource($this->project):null,
            'receiver_id' => $this->receiver ? new UserMinimalResource($this->receiver) : null,
            'sender_id' => $this->sender ? new UserMinimalResource($this->sender) : null,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ];
    }
}
