<?php

namespace Modules\Locations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class LocationMiniResource extends JsonResource
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
            'name' => $this->value ? $this->value : $this->default_value,
            'default_value' => $this->default_value,
            'second_title' => $this->second_title ? $this->second_title : $this->default_second_title,

        ];
    }
}
