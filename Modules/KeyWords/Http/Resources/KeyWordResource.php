<?php

namespace Modules\KeyWords\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Inventory\Http\Resources\IPurposeResource;
use Modules\Locations\Http\Resources\LocationResource;

class KeyWordResource extends JsonResource
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
            'title' => $this->value ? $this->value : "",
            'price_from' => $this->price_from ? $this->price_from : "",
            'price_to' => $this->price_to ? $this->price_to : "",
            'cities' => $this->cities ? LocationResource::collection($this->cities) : null,
            'regions' => $this->regions ? LocationResource::collection($this->regions) : null,
            'types' => $this->types ? IPurposeResource::collection($this->types) : null,
            'locations' => $this->locations ? LocationResource::collection($this->locations) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
        ];
    }
}
