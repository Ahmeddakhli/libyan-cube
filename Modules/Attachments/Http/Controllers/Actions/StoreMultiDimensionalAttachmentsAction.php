<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Intervention\Image\Facades\Image;

class StoreMultiDimensionalAttachmentsAction
{
    public static function execute($file, $name, $extension = null)
    {
        $path = storage_path('app/public/dimensionals/uploads');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $dimensionals_array = [
            ['width' => 1125, 'height' => 450],
            ['width' => 720, 'height' => 300],
            ['width' => 825, 'height' => 500],
            ['width' => 280, 'height' => 300],
            ['width' => 370, 'height' => 250],
            ['width' => 560, 'height' => 400],
            ['width' => 125, 'height' => 125],
            ['width' => 150, 'height' => 85],
        ];
        if ($dimensionals_array) {
            if ($file) {
                $counter = 0;
                foreach ($dimensionals_array as $dimissional) {
                    $file_bk = $file;
                    $file_name_to_store = $name . '_' . $dimissional['width'] . 'x' . $dimissional['height'] . '.' . $extension;
                    // Aspect Ratio Image
                    // create new image with transparent background color
                    $background_file = Image::canvas($dimissional['width'], $dimissional['height']);
                    // read image file and resize it to 200x200
                    // but keep aspect-ratio and do not size up,
                    // so smaller sizes don't stretch

                    $image = Image::make($file_bk)->resize($dimissional['width'], $dimissional['height'], function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    });

                    $file_to_upload = $image;
                    // save or do whatever you like
                    $file_name_to_store = $path . '/' . $file_name_to_store;
                    // if (!file_exists($file_name_to_store)) {
                    //     mkdir(public_path($file_name_to_store), 0777, true);
                    // }
                    $file_to_upload->save($file_name_to_store);

                    $counter += 1;
                }
            }
        }
        return true;
    }
}
