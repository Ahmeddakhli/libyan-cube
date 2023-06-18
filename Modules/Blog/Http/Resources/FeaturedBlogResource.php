<?php

namespace Modules\Blog\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class FeaturedBlogResource extends JsonResource
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
            'title' => $this->value ? $this->value : $this->default_value,
            'creator' => $this->creator ?  $this->creator : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',blogs,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',blogs,' . $this->id . ',' . 'attachments')) : null,
        ];
    }
}
