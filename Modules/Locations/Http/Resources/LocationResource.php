<?php

namespace Modules\Locations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class LocationResource extends JsonResource
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
            'description' => $this->description ? $this->description : $this->default_description,
            'meta_title' => $this->meta_title ? $this->meta_title : $this->default_meta_title,
            'meta_description' => $this->meta_description ? $this->meta_description : $this->default_meta_description,
            'slug' => $this->slug,
            'code' => $this->code,
            'order' => $this->order,
            'projects_count' => $this->projects_count ? $this->projects_count : '',
            'units_count' => $this->units_count ? $this->units_count : '',
            'is_active' => $this->is_active ? true : false,
            'children' => !empty($this->children) ? CityResource::collection($this->children) : [],
            'creator' => $this->creator ? new UserMinimalResource($this->creator) : null,
            'editor' => $this->editor ? new UserMinimalResource($this->editor) : null,
            'destroyer' => $this->destroyer ? new UserMinimalResource($this->destroyer) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
