<?php

namespace Modules\Compares\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Inventory\Http\Resources\IUnitMinimalResource;
use App\Http\Resources\UserMinimalResource;

class CompareResource extends JsonResource
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
            'unit' => new IUnitMinimalResource($this->unit),
            'user' => new UserMinimalResource($this->user)
        ];
    }
}
