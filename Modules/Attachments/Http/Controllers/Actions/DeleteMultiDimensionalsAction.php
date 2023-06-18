<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Illuminate\Support\Facades\Storage;

class DeleteMultiDimensionalsAction
{
    public function execute($media)
    {
        $ex = pathinfo($media->file_name, PATHINFO_EXTENSION);
        $name = pathinfo($media->file_name, PATHINFO_FILENAME);
        $dimensionals_array = [
            ['width' => 1349, 'height' => 437],
            ['width' => 730, 'height' => 400],
            ['width' => 270, 'height' => 200],
            ['width' => 350, 'height' => 265],
            ['width' => 540, 'height' => 400],
            ['width' => 180, 'height' => 75],
        ];
        
        foreach ($dimensionals_array as $dimissional) {
            $path = '/dimensionals/uploads' . '/' . $name . '_' . $dimissional['width'] . 'x' . $dimissional['height'] . '.' . $ex;
            try {
                Storage::disk('public')->delete($path);
            } catch (\Throwable $th) {
            }
        }
    }
}
