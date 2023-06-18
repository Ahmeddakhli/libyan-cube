<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use App\Http\Resources\MediaResource;

class IPhaseResource extends JsonResource
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
            'name' => $this->value,
            'description' => $this->description,
            'delivery_date' => $this->delivery_date,
            'project_id' => $this->project_id,
            'attachments' => MediaResource::collection($this->getMedia(request()->getHttpHost() . ',inventory,phases,' . $this->id . ',' . 'attachments')),
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
