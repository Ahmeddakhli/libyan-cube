<?php

namespace Modules\Testimonials\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaResource;

class TestimonialResource extends JsonResource
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
            'name' => $this->name ? $this->name : null,
            'title' => $this->value ? $this->value : $this->default_value,
            'description' => $this->description ? $this->description : $this->default_description,
            'created_at' => $this->created_at,
            'attachments' => $this->getMedia(request()->getHttpHost() . ',testimonials,testimonials,' . $this->id . ',' . 'attachments') ? MediaResource::collection($this->getMedia(request()->getHttpHost() . ',testimonials,testimonials,' . $this->id . ',' . 'attachments')) : [],
        ];
    }
}
