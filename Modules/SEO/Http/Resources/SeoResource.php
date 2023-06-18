<?php

namespace Modules\SEO\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
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
            'title' => $this->value ? $this->value : $this->default_value,
            'description' => $this->description ? $this->description : $this->default_description,
            'key_words' => $this->key_words ? $this->key_words : $this->default_key_words,
            'popup_contact_us_title' => $this->popup_contact_us_title ? $this->popup_contact_us_title : $this->default_popup_contact_us_title,
            'short_description' => $this->short_description ? $this->short_description : $this->default_short_description,
            'show_short_description' => $this->show_short_description,
            'page' => $this->page,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->diffForHumans() : null
        ];
    }
}
