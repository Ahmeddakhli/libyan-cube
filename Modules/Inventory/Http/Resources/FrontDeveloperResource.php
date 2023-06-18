<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Locations\Http\Resources\LocationResource;

class FrontDeveloperResource extends JsonResourceCollection
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
            'data' => $this->collection->transform(function ($developer) {
                return [
                    'id' => $developer->id,
                    'slug' => $developer->slug,
                    'developer' => $developer->value ? $developer->value : '',
                    'description' => $developer->description ? $developer->description : '',
                    'meta_title' => $developer->meta_title ? $developer->meta_title : null,
                    'meta_description' => $developer->meta_description ? $developer->meta_description : null,
                    'country' => $developer->country ?  new LocationResource($developer->country) : null,
                    'region' => $developer->region ? new LocationResource($developer->region) : null,
                    'city' => $developer->city ? new LocationResource($developer->city) : null,
                    'area' => $developer->area ? new LocationResource($developer->area) : null,
                    'creator' => $developer->creator ? new UserMinimalResource($developer->creator) : null,
                    'editor' => $developer->editor ? new UserMinimalResource($developer->editor) : null,
                    'destroyer' => $developer->destroyer ? new UserMinimalResource($developer->destroyer) : null,
                    'created_at' => $developer->created_at ? $developer->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'updated_at' => $developer->updated_at ? $developer->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'created_since' => $developer->created_at ? $developer->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                    'updated_since' => $developer->updated_at ? $developer->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                    'attachments' => $developer->getMedia(request()->getHttpHost() . ',inventory,developers,' . $developer->id . ',' . 'attachments') ? MediaResource::collection($developer->getMedia(request()->getHttpHost() . ',inventory,developers,' . $developer->id . ',' . 'attachments')) : null,
                ];
            }),
            'pagination' => $this->additional
        ];
    }
}
