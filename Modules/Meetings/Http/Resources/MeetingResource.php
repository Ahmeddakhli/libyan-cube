<?php

namespace Modules\Meetings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class MeetingResource extends JsonResource
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
            'user' => $this->user ? new UserMinimalResource($this->user) : null,
            'meeting_type' => $this->meeting_type,
        ];
    }
}
