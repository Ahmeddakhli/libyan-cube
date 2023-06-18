<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;

class IUnitTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price_from = null;
        if ($this->price_from) {
            // hundreds
            if ($this->price_from <= 999) {
                $price_from = $this->price_from;
            }
            // thousands
            else if ($this->price_from >= 1000 && $this->price_from <= 999999) {
                $price_from = round(($this->price_from / 1000),2).'K';
            }
            // millions
            else if ($this->price_from >= 1000000 && $this->price_from <= 999999999) {
                $price_from = round(($this->price_from / 1000000),2).'M';
            }
            // billions
            else if ($this->price_from >= 1000000000 && $this->price_from <= 999999999999) {
                $price_from = round(($this->price_from / 1000000000),2).'B';
            } else {
                $price_from = $this->price_from;
            }
        }

        $price_to = null;
        if ($this->price_to) {
            // hundreds
            if ($this->price_to <= 999) {
                $price_to = $this->price_to;
            }
            // thousands
            else if ($this->price_to >= 1000 && $this->price_to <= 999999) {
                $price_to = round(($this->price_to / 1000),2).'K';
            }
            // millions
            else if ($this->price_to >= 1000000 && $this->price_to <= 999999999) {
                $price_to = round(($this->price_to / 1000000),2).'M';
            }
            // billions
            else if ($this->price_to >= 1000000000 && $this->price_to <= 999999999999) {
                $price_to = round(($this->price_to / 1000000000),2).'B';
            } else {
                $price_to = $this->price_to;
            }
        }

        return [
            'id' => $this->id,
            'unit_type' => $this->value ? $this->value : $this->default,
            'description' => $this->description ? $this->description : $this->default_description,
            'area_from' => $this->area_from ? round($this->area_from, 2)  : null,
            'area_to' => $this->area_to ? round($this->area_to, 2) : null,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'project' => $this->project,
            'units' => $this->units ? IUnitHomeResource::collection($this->units) : null,
            'image' => $this->image ? asset('/storage/' . $this->image) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
