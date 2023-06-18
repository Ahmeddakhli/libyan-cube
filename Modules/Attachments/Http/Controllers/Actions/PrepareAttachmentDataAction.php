<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use Modules\Attachments\Entities\Attachmentable;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class PrepareAttachmentDataAction
{
    public function execute($attachments, $destination, $modal, $type)
    {


        foreach ($attachments as $attachment) {

            if (isset($attachment['file']) && $attachment['file']) {
                // Upload multiple dimensionals Attachments
                $attachment_file = $attachment['file'];
                $file_name_with_extension = $attachment_file->getClientOriginalName();
                $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
                $extension = $attachment_file->getClientOriginalExtension();
                $name = uniqid() . '_' . $file_name_without_extension;

                $action = new StoreMultiDimensionalAttachmentsAction;
                $action->execute($attachment_file, $name, $extension);
                try {
                    $file = $attachment['file'];
                    if (is_array($attachment) && isset($attachment['order']) && $attachment['order']) {
                        $order = $attachment['order'];
                    } else {
                        $order = $modal->attachmentables()->where('type', $type)->count() + 1;
                    }
                    $file_name = $name . '.' . $extension;
                    $project_attachment = new StoreAttachmentAction();
                    $project_attachment = $project_attachment->execute($file, $file_name, $order, $destination, $type, "project");
                    $modal->attachmentables()->save($project_attachment);
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                    ];
                }
            }else {
                if (isset($attachment['attachment_id']) && $attachment['attachment_id']) {
                    if (isset($attachment['name']) && $attachment['name']) {
                        Attachmentable::where('id', $attachment['attachment_id'])->update([
                            'alt' => $attachment['name'],
                            'order' => $attachment['order']
                        ]);
                    }
                }
            }
        }
    }
}
