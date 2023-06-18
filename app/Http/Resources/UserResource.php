<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Integrations\Http\Resources\Google\GoogleAccountResource;
use App\Http\Resources\UserMinimalResource;
use Carbon\Carbon;
use Modules\Ratings\Http\Resources\RatingResource;

class UserResource extends JsonResource
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
            'group' => $this->group,
            'full_name' => $this->full_name,
            'bio' => $this->bio,
            'image' => $this->image ? url('/').'/'.$this->image : url('/').'/storage/profile_images/no_image.jpg',
            'username' => $this->username,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'is_suspended' => $this->is_suspended ? true : false,
            'last_login_at' => $this->last_login_at ? $this->last_login_at : null,
            'last_login_ip' => $this->last_login_ip,
            'connection_id' => $this->connection_id,
            'timezone' => $this->timezone,
            'creator' => $this->creator ? new UserMinimalResource($this->creator) : null,
            'editor' => $this->editor ? new UserMinimalResource($this->editor) : null,
            'destroyer' => $this->destroyer ? new UserMinimalResource($this->destroyer) : null,
            'created_at' => ($this->created_at && auth()->user()) ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'updated_at' => ($this->updated_at && auth()->user()) ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->toDateTimeString() : null,
            'created_since' => ($this->created_at && auth()->user()) ? $this->created_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'updated_since' => ($this->updated_at && auth()->user()) ? $this->updated_at->timezone(auth()->user()?auth()->user()->timezone:'Africa/Cairo')->diffForHumans() : null,
            'rates' => !is_null($this->ratings) && !empty($this->ratings) ?  RatingResource::collection($this->ratings) : [],
        ];
    }
}
