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
use Modules\Locations\Http\Resources\RegionResource;

class IProjectLandingResource extends JsonResource
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
            'project' => $this->value ? $this->value : $this->default_value,
            'meta_title' => $this->meta_title ? $this->meta_title : null,
            'meta_description' => $this->meta_description ? $this->meta_description : null,
            'landing_description' => $this->landing_description ? $this->landing_description : $this->default_landing_description,
            'landing_page_image' => $this->landing_page_image ? asset('/storage/' . $this->landing_page_image) : null,
            // 'units_count' => $this->units ? $this->units->count() : 0,
            'unit_types' => !empty($this->unitTypes) ? IUnitTypeLandingResource::collection($this->unitTypes) : [],
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user() ? auth()->user()->timezone : 'Africa/Cairo' : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? \Carbon\Carbon::parse($this->updated_at)->format('d F Y') : " ",
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,

        ];
    }
}
