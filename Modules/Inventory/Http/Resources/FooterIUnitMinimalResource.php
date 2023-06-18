<?php

namespace Modules\Inventory\Http\Resources;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Lang;
use Modules\Inventory\IUnit;
use Propaganistas\LaravelIntl\Facades\Currency;

class FooterIUnitMinimalResource extends JsonResource
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
            'title' => $this->title ,
            'price' => $this->price ,
            'full_price' => $this->price ,
            'currency_code' => $this->currency_code,
            'default_title' => $this->default_title,
        ];
    }
}
