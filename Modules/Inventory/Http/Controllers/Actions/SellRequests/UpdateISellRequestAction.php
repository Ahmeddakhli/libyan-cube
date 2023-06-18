<?php

namespace Modules\Inventory\Http\Controllers\Actions\SellRequests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Inventory\Http\Resources\ISellRequestResource;
use Modules\Inventory\ISellRequest;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;
use Lang;

class UpdateISellRequestAction
{
    public function execute($id,$data, $attachments = null)
    {
        // Update sell request 
        $i_sell_request = ISellRequest::find($id);

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $errors = array();
            foreach ($attachments as $attachment) {

                $name = uniqid() . '_' . trim($attachment->getClientOriginalName());
                $attachment->move($path, $name);

                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the unit collection
                try {
                    $i_sell_request
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',inventory,sell_requests,' . $i_sell_request->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('inventory::inventory.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }
            }
            if (count($errors)) {
                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        // Update the sell request
        $i_sell_request->update($data);

        // Transform the sell request
        $i_sell_request = new ISellRequestResource($i_sell_request);

        // Return response
        return $i_sell_request;
    }
}
