<?php

namespace Modules\Currencies\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Cache;
use App\Http\Resources\UserMinimalResource;

class CurrencyResource extends JsonResource
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
            'priority' => $this->priority,
            'iso_code' => $this->iso_code,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'subunit' => $this->subunit,
            'subunit_to_unit' => $this->subunit_to_unit,
            'symbol_first' => $this->symbol_first,
            'html_entity' => $this->html_entity,
            'decimal_mark' => $this->decimal_mark,
            'thousands_separator' => $this->thousands_separator,
            'iso_numeric' => $this->iso_numeric,
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
