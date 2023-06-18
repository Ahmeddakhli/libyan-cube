<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use Modules\Inventory\IUnit;
use Propaganistas\LaravelIntl\Facades\Currency;
use Modules\Inventory\Http\Resources\IFacilityResource;

class IUnitExportResource extends JsonResource
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

        // Check rented
        if (!$availability) {
            foreach ($this->rentalCases as $rental_case) {
                $from = $rental_case->from ? Carbon::createFromFormat('Y-m-d H:i:s', $rental_case->from)->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo') : null;
                $to = $rental_case->to ? Carbon::createFromFormat('Y-m-d H:i:s', $rental_case->to)->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo') : null;
                $today = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->toDateTimeString())->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo');
                if ($from->gte($today) || $to->lte($today)) {
                    $availability = Lang::get('inventory::inventory.rented');
                    break;
                } elseif ($from->lte($today) && !$this->to) {
                    $availability = Lang::get('inventory::inventory.rented');
                    break;
                }
            }
        }

        // Available
        if (!$availability) {
            $availability = Lang::get('inventory::inventory.available');
        }

        if ($this->country || $this->region || $this->city || $this->areaPlace) {
            $locations = array();
            if ($this->country) {
                array_push($locations, $this->country->value);
            }
            if ($this->region) {
                array_push($locations, $this->region->value);
            }
            if ($this->city) {
                array_push($locations, $this->city->value);
            }
            if ($this->areaPlace) {
                array_push($locations, $this->areaPlace->value);
            }
            $location = implode(', ', $locations);
        } else {
            $location = null;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'project' => $this->project ? $this->project->value : null,
            'developer' => $this->project ? ($this->project->developer ? $this->project->developer->value : null) : null,
            'compound_size' => $this->project ? (($this->project->area_from ? round($this->project->area_from, 2) : '').($this->project->areaUnit ? (' '.$this->project->areaUnit->value) : '').(($this->project->area_to ? round($this->project->area_to, 2) : '') ? (' - '.$this->project->area_to.($this->project->areaUnit ? (' '.$this->project->areaUnit->value) : '')) : '')) : null,
            'furnishing_status' => $this->furnishingStatus ? $this->furnishingStatus->value : null,
            'delivery_date' => $this->project ? ($this->project->delivery_date ? Carbon::createFromFormat('Y-m-d H:i:s', $this->project->delivery_date)->format('M j, Y') : null) : null,
            'price_per_area_unit' => ($this->price && $this->currency_code && $this->area && $this->areaUnit) ? round($this->price/$this->area, 2).' '.$this->currency_code.'/'.$this->areaUnit->value : null,
            'garden' => ($this->garden_area && $this->gardenAreaUnit) ? ($this->garden_area ? round($this->garden_area, 2) : '').' '.$this->gardenAreaUnit->value : null,
            'rooms' => $this->bedroom ? $this->bedroom->value : null,
            'baths' => $this->bathroom ? $this->bathroom->value : null,
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
            'location' => $location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'area' => $this->area ? round($this->area, 2) : null,
            'roof_area' => $this->roof_area ? round($this->roof_area, 2) : null,
            'terrace_area' => $this->terrace_area ? round($this->terrace_area, 2) : null,
            'area_unit' => $this->areaUnit ? $this->areaUnit->value : null,
            'address' => $this->address ? $this->address : null,
            'offering_type' => ($this->offeringType && $this->offeringType->value) ? $this->offeringType->value : $this->offeringType->default_value,
            'price' => $this->price,
            'currency_code' => $this->currency_code,
            'full_price' => $this->price,
            'down_payment_string' => $this->down_payment,
            'number_of_installments' => $this->number_of_installments,
            'installments' => $this->installments,
            'description' => $this->description,
            'buyer' => $this->buyer ? new UserMinimalResource($this->buyer) : null,
            'availability' => $availability,
            'url' => route('inventory.units.unit', ['id' => $this->id]),
            'finishing_type' => $this->finishingType ? $this->finishingType->value : null,
            'attachments' => $this->attachmentables ? MediaResource::collection($this->attachmentables) : null,
            'facilities' => $this->facilities ? IFacilityResource::collection($this->facilities) : $this->facilities,
        ];
    }
}
