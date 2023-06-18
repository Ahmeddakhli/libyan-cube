<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;

class IRentalCaseResource extends JsonResource
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
            'unit_number' => $this->unit ? $this->unit->unit_number : null,
            'renter' => $this->renter ? new UserMinimalResource($this->renter) : null,
            'from' => $this->from ? Carbon::createFromFormat('Y-m-d H:i:s', $this->from)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'to' => $this->to ? Carbon::createFromFormat('Y-m-d H:i:s', $this->to)->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'price' => $this->price,
            'creator' => $this->creator ? new UserMinimalResource($this->creator) : null,
            'editor' => $this->editor ? new UserMinimalResource($this->editor) : null,
            'destroyer' => $this->destroyer ? new UserMinimalResource($this->destroyer) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
