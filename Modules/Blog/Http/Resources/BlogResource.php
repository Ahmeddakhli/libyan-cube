<?php

namespace Modules\Blog\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class BlogResource extends JsonResource
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
            'description' => $this->description ? $this->description : $this->default_description,
            'meta_title' => $this->meta_title ? $this->meta_title : $this->default_value,
            'meta_description' => $this->meta_description ? $this->meta_description : $this->default_description,
            'categories' => $this->categories ? BlogCategoryResource::collection($this->categories) : null,
            'category_id' => $this->category_id,
            'creator' => $this->creator ?  new UserMinimalResource($this->creator) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',blogs,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',blogs,' . $this->id . ',' . 'attachments')) : null,
        ];
    }
}
