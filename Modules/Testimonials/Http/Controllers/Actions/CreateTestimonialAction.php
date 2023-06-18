<?php

namespace Modules\Testimonials\Http\Controllers\Actions;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Modules\Testimonials\Testimonial;
use Modules\Testimonials\TestimonialTranslation;
use Modules\Testimonials\Http\Resources\TestimonialResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateTestimonialAction
{
    function execute($data, $translations = null, $attachments = null)
    {
        // Create testimonial
        $testimonial = Testimonial::create($data);

        // Create translations
        foreach ($translations as $value) {
            $value['testimonial_id'] = $testimonial->id;
            TestimonialTranslation::insert($value);
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
                    ];
                }
            }
            if (count($errors)) {
                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        // Update for cache translation 
        $testimonial->update();

        // Return transformed response 
        return new TestimonialResource($testimonial);
    }
}
