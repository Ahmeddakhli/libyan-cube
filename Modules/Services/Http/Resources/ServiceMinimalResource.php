<?php

namespace Modules\Services\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceMinimalResource extends JsonResource
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
            'title' => $this->value ? $this->value : '',
            'icon' => $this->icon ? $this->icon : null,
        ];
    }
}
