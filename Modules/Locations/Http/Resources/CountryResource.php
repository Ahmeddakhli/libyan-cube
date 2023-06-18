<?php

namespace Modules\Locations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class CountryResource extends JsonResource
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
            'name' => $this->value ? $this->value : '',
            'default_value' => $this->default_value,
            'second_title' => $this->second_title ? $this->second_title : $this->default_second_title,
            'slug' => $this->slug,
            'code' => $this->code,
            'order' => $this->order,
            'is_active' => $this->is_active ? true : false,
        ];
    }
}
