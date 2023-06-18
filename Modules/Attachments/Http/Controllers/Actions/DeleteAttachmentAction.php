<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Attachments\Entities\Attachmentable;
use Illuminate\Support\Facades\Storage;
use App\Media;

class DeleteAttachmentAction
{
	/** 
	 * @param [integer] id
	 * @return [Boolean] return
	 */
	public function execute($id)
	{
		$attachment = Attachmentable::find($id);
		// Delete Multi dimensionals
		$action = new DeleteMultiDimensionalsAction;
		$action->execute($attachment);

		Storage::disk('public')->delete($attachment->path);
		$return = $attachment->delete();

		return $return;
	}
}
