<?php

namespace Modules\Attachments\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attachments\Http\Controllers\Actions\StoreAttachmentAction;
use Modules\Attachments\Http\Controllers\Actions\DeleteAttachmentAction;
use Modules\Attachments\Http\Requests\StoreAttachmentRequest;
use Modules\Attachments\Http\Requests\DeleteAttachmentRequest;
use App\Http\Helpers\ServiceResponse;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Modules\Attachments\Http\Requests\DeleteMediaAttachmentRequest;

class AttachmentablesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreAttachmentRequest $request, StoreAttachmentAction $action)
    {
        $validated = $request->validated();
        $attachment = $action->execute($validated);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Attachment created successfully';
        $resp->status = true;
        $resp->data = $attachment;
        return response()->json($resp, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete(DeleteAttachmentRequest $request, DeleteAttachmentAction $action)
    {
        $response = $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Deleted successfully';
        $resp->status = true;
        $resp->data = $response;
        return response()->json($resp, 200);
    }
    public function deleteMedia(DeleteMediaAction $action, DeleteMediaAttachmentRequest $request)
    {
        $media_delete = $action->execute($request->id);
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Deleted successfully';
        $resp->status = true;
        $resp->data = $media_delete;
        return response()->json($resp, 200);
    }
}
