<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Attachments\Entities\Attachmentable;
use Intervention\Image\Facades\Image;

class StoreAttachmentAction
{
	/**
	 * @param [Request] request
	 * @param [integer] order
	 * @param [string] destination
	 * @param [string] type
	 * @return [Attachmentable] attachment
	 */
	public function execute($request, $file_name, $order, $destination, $type  ,$falg="unit")
	{
		$data = [
			'mime' => $request->getClientOriginalExtension(),
			'path' => $request->storeAs($destination, $file_name, 'public'),
			'size' => $request->getSize(),
			'order' => $order,
			'file_name' => $file_name,
			'alt' => $file_name,
			'type' => $type
		];

		// Create attachmentable record
		$attachment = Attachmentable::create($data);
        if ($falg=="project") {
                    // Store the file
                $image = Image::make(public_path('storage/' . $attachment->path));
                // $waterMark = Image::make(public_path('front/img/icons/logo.png'));
                // $waterMark->opacity(75);
                // $image->insert($waterMark, 'center-bottom', 50, 50);
                $image->save(public_path('storage/' . $attachment->path));

                // Return the attachment
                return $attachment;
        }
		// Store the file
		$image = Image::make(public_path('storage/' . $attachment->path));
		// $waterMark = Image::make(public_path('front/img/icons/logo.png'));
        $waterMark = Image::make(env('APP_URL').'front/img/icons/logo.png');

		$waterMark->opacity(75);
		$image->insert($waterMark, 'center-bottom', 50, 50);
		$image->save(public_path('storage/' . $attachment->path));

		// Return the attachment
		return $attachment;
	}
}
