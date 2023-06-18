<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use Modules\Locations\Http\Resources\LocationResource;
use Propaganistas\LaravelIntl\Facades\Currency;

class IProjectMinimalResource extends JsonResource
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
                $price_from = round(($this->price_from / 1000), 2) . 'K';
            }
            // millions
            else if ($this->price_from >= 1000000 && $this->price_from <= 999999999) {
                $price_from = round(($this->price_from / 1000000), 2) . 'M';
            }
            // billions
            else if ($this->price_from >= 1000000000 && $this->price_from <= 999999999999) {
                $price_from = round(($this->price_from / 1000000000), 2) . 'B';
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
                $price_to = round(($this->price_to / 1000), 2) . 'K';
            }
            // millions
            else if ($this->price_to >= 1000000 && $this->price_to <= 999999999) {
                $price_to = round(($this->price_to / 1000000), 2) . 'M';
            }
            // billions
            else if ($this->price_to >= 1000000000 && $this->price_to <= 999999999999) {
                $price_to = round(($this->price_to / 1000000000), 2) . 'B';
            } else {
                $price_to = $this->price_to;
            }
        }

        return [
            'id' => $this->id,
            'project' => $this->value,
            'second_title' => $this->second_title ? $this->second_title : $this->default_second_title,
            'default_value' => $this->default_value,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'developer' => $this->developer ? new IDeveloperMiniResource($this->developer) : null,
            'full_price_from' => $this->price_from,
            'full_price_to' => $this->price_to,
            'area_from' => $this->area_from ? round($this->area_from, 2) : null,
            'area_to' => $this->area_to ? round($this->area_to, 2) : null,
            'currency_code' => $this->currency_code,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title ? $this->meta_title : null,
            'meta_description' => $this->meta_description ? $this->meta_description : null,
            'down_payment_from' => $this->down_payment_from,
            'delivery_date' => $this->delivery_date ? date('Y-m-d', strtotime($this->delivery_date)): '',
            'landing_page_image' => $this->landing_page_image ? asset('/storage/' . $this->landing_page_image) : null,
            'payment_plans' => $this->paymentPlans,
            // 'creator' => $this->creator ? new UserMinimalResource($this->creator) : null,
            // 'editor' => $this->editor ? new UserMinimalResource($this->editor) : null,
            // 'destroyer' => $this->destroyer ? new UserMinimalResource($this->destroyer) : null,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user() ? auth()->user()->timezone : 'Africa/Cairo' : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,

        ];
    }
}
