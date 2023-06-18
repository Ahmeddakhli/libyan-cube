<?php

namespace Modules\Attachments\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Attachments\Http\Controllers\Actions\StoreAttachmentAction;
use Modules\Attachments\Http\Controllers\Actions\DeleteAttachmentAction;
use Modules\Attachments\Http\Requests\StoreAttachmentRequest;
use Modules\Attachments\Http\Requests\DeleteAttachmentRequest;
use App\Http\Helpers\ServiceResponse;
use Modules\Attachments\Http\Controllers\Actions\DeleteMediaAction;
use Modules\Attachments\Http\Controllers\Actions\GetAttachmentsAction;
use Modules\Attachments\Http\Requests\DeleteMediaAttachmentRequest;

class AttachmentsController extends Controller
{
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
        $resp->message = 'Attachment Deleted successfully';
        $resp->status = true;
        $resp->data = $response;
        return response()->json($resp, 200);
    }
    /**
     * Remove media from from storage.
     * @param int $id
     * @return Response
     */
    public function deleteMedia(DeleteMediaAction $action, DeleteMediaAttachmentRequest $request)
    {
        $action->execute($request->id);
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Media attachment deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    public function index(Request $request)
    {
        $attachments = (new GetAttachmentsAction)->execute($request);

        return view('attachments::attachments.index',compact('attachments'));
    }
}
