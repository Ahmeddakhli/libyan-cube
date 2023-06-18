<?php

namespace Modules\Inventory\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use Modules\Inventory\Http\Resources\IFacilityMinimalResource;
use Modules\Inventory\Http\Resources\IAmenityMinimalResource;
use Modules\Inventory\Http\Resources\IPhaseResource;
use App\Http\Resources\MediaResource;
use Modules\Locations\Http\Resources\LocationResource;
use Propaganistas\LaravelIntl\Facades\Currency;
use Modules\Ratings\Http\Resources\RatingResource;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use Modules\Tags\Http\Resources\TagResource;
use Modules\Inventory\IPurposeType;
use Modules\Inventory\Http\Resources\IPurposeTypeResource;
use Modules\Locations\Http\Resources\CityResource;
use Modules\Locations\Http\Resources\CountryResource;
use Modules\Locations\Http\Resources\LocationMiniResource;
use Modules\Locations\Http\Resources\RegionResource;

class IProjectHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $purpose_types = IPurposeTypeResource::collection(IPurposeType::whereIn('id', $this->units->pluck('i_purpose_type_id')->toArray())->get());
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
            'slug' => $this->slug,
            'project' => $this->value ? $this->value : $this->default_value,
            'second_title' => $this->second_title ? $this->second_title : $this->default_second_title,
            'default_value' => $this->default_value,
            
            // 'meta_title' => $this->meta_title ? $this->meta_title : null,
            // 'meta_description' => $this->meta_description ? $this->meta_description : null,
            'developer' => $this->developer ? new IDeveloperResource($this->developer) : null,
            'delivery_date' => $this->delivery_date ? date('Y', strtotime($this->delivery_date)):'',
            // 'finished_status' => $this->finished_status ? Lang::get('inventory::inventory.finished') : Lang::get('inventory::inventory.not_finished'),
            'area_from' => $this->area_from ? round($this->area_from, 2) : null,
            // 'area_to' => $this->area_to ? round($this->area_to, 2) : null,
            'country' => $this->country ?  new LocationMiniResource($this->country) : null,
            'region' => $this->region ? new LocationMiniResource($this->region) : null,
            'city' => $this->city ? new LocationMiniResource($this->city) : null,
            'area' => $this->area ? new LocationResource($this->area) : null,
            // 'latitude' => (float) $this->latitude,
            // 'longitude' => (float) $this->longitude,
            // 'is_featured' => $this->is_featured,
            // 'address' => $this->address,
            // 'description' => $this->description ? $this->description : $this->default_description,
            // 'landing_description' => $this->landing_description ? $this->landing_description : $this->default_landing_description,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'currency_code' => $this->currency_code,
            'down_payment_from' => $this->down_payment_from,
            // 'down_payment_to' => $this->down_payment_to,
            // 'video' => $this->video,
            'number_of_installments_from' => $this->number_of_installments_from,
            // 'number_of_installments_to' => $this->number_of_installments_to,
            'units_count' => $this->units ? $this->units->count() : 0,
            'landing_page_image' => $this->landing_page_image ? asset('/storage/' . $this->landing_page_image) : null,
            // 'unit_types' => !empty($this->unitTypes) ? IUnitTypeResource::collection($this->unitTypes) : [],
            // 'area_unit' => $this->areaUnit ? $this->areaUnit->value : null,
            // 'facilities' => $this->facilities ? IFacilityMinimalResource::collection($this->facilities) : null,
            // 'amenities' => $this->amenities ? IAmenityMinimalResource::collection($this->amenities) : null,
            'tags' => $this->tags ? TagResource::collection($this->tags) : null,
            // 'attachmentables' => $this->attachmentables ? MediaResource::collection($this->attachmentables) : null,
            'attachments' => $this->attachments ? MediaResource::collection($this->attachments) : null,
            // // 'floor_plans' => $this->floorPlans ? MediaResource::collection($this->floorPlans) : null,
            // // 'rate' => !is_null($this->ratings) && !empty($this->ratings) ? floor($this->ratings()->avg('rate')) : null,
            // 'class' => get_class($this->resource),
            // 'purpose_types' => $purpose_types,
            // 'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user() ? auth()->user()->timezone : 'Africa/Cairo' : 'Africa/Cairo')->toDateTimeString() : null,
            // 'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            // 'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            // 'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,

        ];
    }
}
