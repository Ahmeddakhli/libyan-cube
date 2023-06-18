<?php

namespace Modules\Blog\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FrontBlogResource extends JsonResourceCollection
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
            'data' => $this->collection->transform(function ($page) {
                return [
                    'id' => $page->id,
                    'slug' => $page->slug,
                    'title' => $page->value ? $page->value : null,
                    'description' => $page->description ? $page->description : null,
                    'meta_title' => $page->meta_title ? $page->meta_title : null,
                    'meta_description' => $page->meta_description ? $page->meta_description : null,
                    'creator' => $page->creator ?  new UserMinimalResource($page->creator) : null,
                    'created_at' => $page->created_at ? $page->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'updated_at' => $page->updated_at ? $page->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'created_since' => $page->created_at ? $page->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                    'updated_since' => $page->updated_at ? $page->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                    'attachments' => $page->getMedia(request()->getHttpHost() . ',blogs,' . $page->id . ',' . 'attachments') ? MediaResource::collection($page->getMedia(request()->getHttpHost() . ',blogs,' . $page->id . ',' . 'attachments')) : null,
                ];
            }),
            'pagination' => $this->additional
        ];
    }
}
