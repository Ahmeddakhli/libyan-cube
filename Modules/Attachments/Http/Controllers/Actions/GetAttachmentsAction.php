<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use App\Http\Resources\MediaResource;
use App\Media;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Attachments\Entities\Attachmentable;
use Modules\Attachments\Http\Resources\AttachmentableResource;

class GetAttachmentsAction
{
    public function execute($request)
    {
        $attachments = Attachmentable::paginate(20);

        // Transform result
        $attachments = MediaResource::collection($attachments);
        $attachments = new LengthAwarePaginator(
            json_decode(json_encode($attachments)),
            $attachments->total(),
            $attachments->perPage(),
            $attachments->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $attachments->currentPage()
                ]
            ]
        );

        $media = Media::paginate(20);

        // Transform result
        $media = MediaResource::collection($media);
        $media = new LengthAwarePaginator(
            json_decode(json_encode($media)),
            $media->total(),
            $media->perPage(),
            $media->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $media->currentPage()
                ]
            ]
        );



        return [
            'attachments' => $attachments,
            'media' => $media
        ];
    }
}
