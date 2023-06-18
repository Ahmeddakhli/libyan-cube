<?php

namespace Modules\Testimonials\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Testimonials\Http\Controllers\Actions\CreateTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\DeleteTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\GetTestimonialsAction;
use Modules\Testimonials\Http\Controllers\Actions\UpdateTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\DeleteTestimonialAttachmentAction;
use Modules\Testimonials\Http\Requests\CreateTestimonialRequest;
use Modules\Testimonials\Http\Requests\DeleteTestimonialRequest;
use Modules\Testimonials\Http\Requests\UpdateTestimonialRequest;
use Modules\Testimonials\Http\Resources\TestimonialResource;
use Modules\Testimonials\Testimonial;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use App\Language;

class TestimonialsController extends Controller
{
    /**
     * Store testimonial
     *
     * @param  [array] attachments
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateTestimonialRequest $request, CreateTestimonialAction $action)
    {
        // Create the testimonial
        $testimonial = $action->execute($request->except(['attachments']), $request->translations, $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Testimonial created successfully';
        $resp->status = true;
        $resp->data = $testimonial;
        return response()->json($resp, 200);
    }

    /**
     * Update testimonial
     *
     * @param  [integer] id
     * @param  [array] attachments
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateTestimonialRequest $request, UpdateTestimonialAction $action)
    {
        // Update the testimonial
        $testimonial = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->translations, $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Testimonial updated successfully';
        $resp->status = true;
        $resp->data = $testimonial;
        return response()->json($resp, 200);
    }

    /**
     * Delete testimonial
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteTestimonialRequest $request, DeleteTestimonialAction $action)
    {
        // Delete the testimonial
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Testimonial deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index testimonials
     * @return Response
     */
    public function index(Request $request, GetTestimonialsAction $action)
    {
        $testimonials = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Testimonials retrieved successfully';
        $resp->status = true;
        $resp->data = $testimonials;
        return response()->json($resp, 200);
    }
}
