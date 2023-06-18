<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;

class IDesignTypeResource extends JsonResource
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
            'order' => $this->order,
            'type' => $this->value,
            'description' => $this->description,
            'attachments' => $this->getMedia(request()->getHttpHost().',inventory,design_types,'.$this->id.','.'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost().',inventory,design_types,'.$this->id.','.'attachments')) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
