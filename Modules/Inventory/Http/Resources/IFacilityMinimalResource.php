<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class IFacilityMinimalResource extends JsonResource
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
            'facility' => $this->value ? $this->value : null,
            // 'description' => $this->description ?$this->description :null,
            'color_class' => $this->color_class,
            'svg' => $this->svg,
            // 'attachments' => $this->getMedia(request()->getHttpHost().',inventory,facilities,'.$this->id.','.'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost().',inventory,facilities,'.$this->id.','.'attachments')) : null,
        ];
    }
}
