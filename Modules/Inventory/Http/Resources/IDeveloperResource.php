<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Modules\Inventory\IUnit;
use Modules\Locations\Http\Resources\LocationResource;

class IDeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $units_count = 0;
        
        if ($this->projects) {
            $projects = collect($this->projects)->pluck('id')->toArray();
            if (!empty($projects)) {
                $units_count = IUnit::whereIn('i_project_id',$projects)->count();
            }
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'developer' => $this->value ? $this->value : $this->default_value,
            'default_value' => $this->default_value,
            'developer_name' => $this->developer_name ? $this->developer_name : null,
            'developer_email' => $this->developer_email ? $this->developer_email : null,
            'description' => $this->description ? $this->description : $this->default_description,
            'meta_title' => $this->meta_title ? $this->meta_title : null,
            'meta_description' => $this->meta_description ? $this->meta_description : null,
            'country' => $this->country ?  new LocationResource($this->country) : null,
            'region' => $this->region ? new LocationResource($this->region) : null,
            'city' => $this->city ? new LocationResource($this->city) : null,
            'area' => $this->area ? new LocationResource($this->area) : null,
            'projects_count' => $this->projects ? $this->projects->count() : 0,
            'units_count' => $units_count,
            // 'creator' => $this->creator ? new UserMinimalResource($this->creator) : null,
            // 'editor' => $this->editor ? new UserMinimalResource($this->editor) : null,
            // 'destroyer' => $this->destroyer ? new UserMinimalResource($this->destroyer) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? \Carbon\Carbon::parse($this->updated_at)->format('d F Y') : " ",
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',inventory,developers,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',inventory,developers,' . $this->id . ',' . 'attachments')) : null,
        ];
    }
}
