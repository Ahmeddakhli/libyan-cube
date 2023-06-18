<?php

namespace Modules\Testimonials\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Testimonials\Testimonial;
use Modules\Testimonials\TestimonialTranslation;
use Modules\Testimonials\Http\Resources\TestimonialResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateTestimonialAction
{
    function execute($id, $data, $translations = null, $attachments = null)
    {
        // Find testimonial
        $testimonial = Testimonial::find($id);

        // Create\Update translations
        foreach ($translations as $value) {
            $testimonialTrans = TestimonialTranslation::where('testimonial_id', $testimonial->id)->where('language_id', $value['language_id'])->first();
            $value['testimonial_id'] = $testimonial->id;
            if ($testimonialTrans) {
                TestimonialTranslation::where('testimonial_id', $testimonial->id)->where('language_id', $value['language_id'])->update($value);
            } else {
                TestimonialTranslation::insert($value);
            }
        }

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
                    $testimonial
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',testimonials,testimonials,' . $testimonial->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('testimonials::testimonial.file_is_unacceptable')
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

        // Update testimonial
        $testimonial->update($data);

        // Return transformed response
        return new TestimonialResource($testimonial);
    }
}
