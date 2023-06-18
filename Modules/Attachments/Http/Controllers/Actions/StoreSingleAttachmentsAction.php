<?php

namespace Modules\Attachments\Http\Controllers\Actions;

class StoreSingleAttachmentsAction
{
    public function execute($image,$destination)
    {
        $unit_type_file = $image;
        // Store the unit_type_file
        $file_name_with_extension = $unit_type_file->getClientOriginalName();
        $file_name_without_extension = pathinfo($file_name_with_extension, PATHINFO_FILENAME);
        $unit_type_extension = $unit_type_file->getClientOriginalExtension();
        $unit_type_name = uniqid() . '_' . $file_name_without_extension;
        $unit_type_file_name = $unit_type_name . '.' . $unit_type_extension;

        $response = $image->storeAs($destination, $unit_type_file_name, 'public');

        // Create Multi dimensionals
        $action = new StoreMultiDimensionalAttachmentsAction;
        $action->execute($unit_type_file, $unit_type_name, $unit_type_extension);

        return $response;
    }
}
