<?php

namespace Modules\Services\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FrontServiceResource extends ResourceCollection
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
            'data' => $this->collection->transform(function ($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->value ? $service->value : null,
                    'creator' => $service->creator ?  new UserMinimalResource($service->creator) : null,
                    'created_at' => $service->created_at ? $service->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'updated_at' => $service->updated_at ? $service->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
                    'created_since' => $service->created_at ? $service->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                    'updated_since' => $service->updated_at ? $service->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
                ];
            }),
            'pagination' => $this->additional
        ];
    }
}
