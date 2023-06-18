<?php

namespace Modules\Ratings\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'rate' => $this->rate,
            'rateable' => $this->rateable,
            'rateable_type' => $this->rateable_type,
            'rateable_id' => $this->rateable_id,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
        ];
    }
}
