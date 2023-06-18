<?php

namespace Modules\Compares\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Inventory\Http\Resources\IUnitExportResource;
use App\Http\Resources\UserMinimalResource;

class CompareExportResource extends JsonResource
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
            'unit' => new IUnitExportResource($this->unit),
            'user' => new UserMinimalResource($this->user)
        ];
    }
}
