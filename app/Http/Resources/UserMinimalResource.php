<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserMinimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'bio' => $this->bio,
            'image' => asset($this->image),
            'group' => $this->group ? $this->group->name : null,
            'mobile_number' => $this->mobile_number,
        ];
    }
}
