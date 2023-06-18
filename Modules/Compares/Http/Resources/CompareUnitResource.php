<?php

namespace Modules\Compares\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompareUnitResource extends JsonResource
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
            'unit_number' => $this->unit_number,
            'bedroom' => $this->bedroom ? $this->bedroom->value : null,
            'bathroom' => $this->bathroom ? $this->bathroom->value : null,
            'purpose_type' => $this->purposeType ? $this->purposeType->value : null,
            'country' => $this->country ? $this->country->value : null,
            'region' => $this->region ? $this->region->value : null,
            'city' => $this->city ? $this->city->value : null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'offering_type' => $this->offeringType ? $this->offeringType->value : null,
            'price' => $this->price,
            'finishing_type' => $this->finishingType ? $this->finishingType->value : null,
            'attachments' => $this->attachmentables ? MediaResource::collection($this->attachmentables) : null,
        ];
    }
}
