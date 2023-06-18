<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use App\Http\Resources\MediaResource;

class ISellRequestResource extends JsonResource
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
            'compound' => $this->compound,
            'purpose_type' => $this->purposeType ? $this->purposeType->value : null,
            'unit_name' => $this->unit_name,
            'comments' => $this->comments,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_seen' => $this->is_seen,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',inventory,sell_requests,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',inventory,sell_requests,' . $this->id . ',' . 'attachments')) : null,
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
