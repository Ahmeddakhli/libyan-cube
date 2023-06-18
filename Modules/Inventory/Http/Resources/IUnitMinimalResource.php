<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use Modules\Inventory\IUnit;
use Propaganistas\LaravelIntl\Facades\Currency;

class IUnitMinimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $availability = null;

        // Check sold
        if ($this->buyer) {
            $availability = Lang::get('inventory::inventory.sold');
        }
    
        $price = null;
        // hundreds
        if ($this->price <= 999) {
            $price = $this->price;
        }
        // thousands
        else if ($this->price >= 1000 && $this->price <= 999999) {
            $price = round(($this->price / 1000),2).'K';
        }
        // millions
        else if ($this->price >= 1000000 && $this->price <= 999999999) {
            $price = round(($this->price / 1000000),2).'M';
        }
        // billions
        else if ($this->price >= 1000000000 && $this->price <= 999999999999) {
            $price = round(($this->price / 1000000000),2).'B';
        } else {
            $price = $this->price;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'default_title' => $this->default_title,
            'slug' => $this->slug,
            'project' => $this->project ? $this->project->value : null,
            'unit_number' => $this->unit_number,
            'seller' => $this->seller ? new UserMinimalResource($this->seller) : null,
            'bedroom' => $this->bedroom ? $this->bedroom->count : null,
            'bathroom' => $this->bathroom ? $this->bathroom->count : null,
            'purpose_type' => $this->purposeType ? $this->purposeType->value : null,
            'purpose_type_object' => $this->purposeType ? $this->purposeType : null,
            'country' => $this->country ? $this->country->value : null,
            'region' => $this->region ? $this->region->value : null,
            'city' => $this->city ? $this->city->value : null,
            'area_place' => $this->areaPlace ? $this->areaPlace->value : null,
            'latitude' => $this->latitude,
            'video' => $this->video,
            'longitude' => $this->longitude,
            'area' => $this->area,
            'roof_area' => $this->roof_area,
            'terrace_area' => $this->terrace_area,
            'area_unit' => $this->areaUnit ? $this->areaUnit->value : null,
            'address' => $this->address ? $this->address : null,
            'offering_type' => ($this->offeringType && $this->offeringType->value) ? $this->offeringType->value : $this->offeringType->default_value,
            'offering_type_id' => $this->i_offering_type_id,
            'price' => $price,
            'currency_code' => $this->currency_code,
            'full_price' => $this->price,
            'down_payment_string' => $this->down_payment,
            'number_of_installments' => $this->number_of_installments,
            'description' => $this->description ? $this->description : $this->default_description,
            'meta_title' => $this->meta_title ? $this->meta_title : null,
            'meta_description' => $this->meta_description ? $this->meta_description : null,
            'buyer' => $this->buyer ? new UserMinimalResource($this->buyer) : null,
            'area_unit' => $this->areaUnit ? $this->areaUnit->value : null,
            'availability' => $availability,
            'payment_plans' => $this->paymentPlans,
            'url' => route('inventory.units.unit', ['id' => $this->id]),
            'finishing_type' => $this->finishingType ? $this->finishingType->value : null,
            'attachments' => $this->attachmentables ? MediaResource::collection($this->attachmentables) : null,
        ];
    }
}
