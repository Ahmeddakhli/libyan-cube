<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class IAmenityMinimalResource extends JsonResource
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
            'amenity' => $this->value,
            'color_class' => $this->color_class,
            'svg' => $this->svg,
            // 'attachments' => $this->getMedia(request()->getHttpHost().',inventory,amenities,'.$this->id.','.'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost().',inventory,amenities,'.$this->id.','.'attachments')) : null,
        ];
    }
}
