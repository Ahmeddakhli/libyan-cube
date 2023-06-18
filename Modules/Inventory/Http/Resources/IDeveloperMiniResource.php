<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Modules\Locations\Http\Resources\LocationResource;

class IDeveloperMiniResource extends JsonResource
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
            'slug' => $this->slug,
            'developer' => $this->value ? $this->value : $this->default_value,
            'developer_name' => $this->developer_name ? $this->developer_name : null,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',inventory,developers,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',inventory,developers,' . $this->id . ',' . 'attachments')) : null,
        ];
    }
}
