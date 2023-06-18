<?php

namespace Modules\Testimonials\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Testimonials\Http\Controllers\Actions\SearchTestimonialsQueryAction;
use Modules\Testimonials\Http\Controllers\Actions\CreateTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\DeleteTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\UpdateTestimonialAction;
use Modules\Testimonials\Http\Controllers\Actions\DeleteTestimonialAttachmentAction;
use Modules\Testimonials\Http\Requests\CreateTestimonialRequest;
use Modules\Testimonials\Http\Requests\DeleteTestimonialRequest;
use Modules\Testimonials\Http\Requests\UpdateTestimonialRequest;
use Modules\Testimonials\Http\Resources\TestimonialResource;
use Modules\Testimonials\Testimonial;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the testimonials
            $action = new SearchTestimonialsQueryAction;
            $testimonials = $action->execute($auth_user, $request);

            return Datatables::of($testimonials)
                ->addColumn('value', function ($testimonial) {
                    return $testimonial->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($testimonial) {
                    return $testimonial->created_at ? $testimonial->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($testimonial) {
                    return $testimonial->updated_at ? $testimonial->updated_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->orderColumn('last_updated_at', function ($query, $order) {
                    return  $query->orderBy('updated_at', $order);
                })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return
            return view('testimonials::testimonials.' . $blade_name);
        }
    }

    /**
     * Create testimonial
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('testimonials::testimonials.' . $blade_name, compact('languages'), []);
    }

    public function createTestimonialModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('testimonials::testimonials.modals.create', compact('languages'), [])->render();
    }

    public function UpdateTestimonialModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $testimonial = Testimonial::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($testimonial->getMedia(request()->getHttpHost() . ',testimonials,testimonials,' . $testimonial->id . ',' . 'attachments'))));

        // If testimonial does not exist, return error div
        if (!$testimonial) {
            $error = Lang::get('testimonials::testimonial.testimonial_not_found_or_you_are_not_authorized_to_edit_the_testimonial');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('testimonials::testimonials.modals.update', compact('testimonial', 'languages', 'attachments'), [])->render();
    }

    public function deleteAttachments(Request $request, DeleteTestimonialAttachmentAction $action)
    {
        // Delete the Testimonial attachment
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Testimonial attachment deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
