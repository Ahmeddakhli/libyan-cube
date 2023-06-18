<?php

namespace Modules\CMS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class CmsManagementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title ? $this->title : $this->default_title,
            'description' => $this->description ? $this->description : $this->default_description,
            'translations' => $this->translations,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
        ];
    }
}
