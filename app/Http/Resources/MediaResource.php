<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Lang;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $file_name_without_extension = pathinfo($this->file_name, PATHINFO_FILENAME);
        $extension = pathinfo($this->file_name, PATHINFO_EXTENSION);

        if(strtotime($this->created_at) < strtotime('3-11-2021')){
            $path = $this->path ? asset('storage/' . $this->path) : asset('storage/' . $this->file_name);
        }else{
            $path = $this->path ? asset('storage/' . $this->path) : asset('storage/' . $this->id . '/' . $this->file_name);
        }
        

        return [
            'id' => $this->id,
            'name' => $this->name ? $this->name : '',
            'file_name_without_extension' => $file_name_without_extension,
            'extension' => $extension,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type ? $this->mime_type : $this->mime,
            'size' => $this->size,
            'is_deleted' => $this->deleted_at ? true : false,
            'path' => $this->path,
            'url' => $path,
            'type' => $this->type ? $this->type : '',
            'alt' => $this->alt
        ];
    }
}
