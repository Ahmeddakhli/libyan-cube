<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserMinimalResource;
class GroupResource extends JsonResource
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
            'parent_group' => $this->parent && $this->parent->id != 1 ? [
                'id' => $this->parent->id,
                'name' => $this->parent->name,
                'slug' => $this->parent->slug,
                'description' => $this->parent->description,
                'is_hidden' => $this->parent->is_hidden ?  true : false,
                'created_at' => $this->parent->created_at ? $this->parent->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
                'updated_at' => $this->parent->updated_at ? $this->parent->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
                'created_since' => $this->created_at ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
                'updated_since' => $this->updated_at ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null
            ] : null,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_hidden' => $this->is_hidden ?  true : false,
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
