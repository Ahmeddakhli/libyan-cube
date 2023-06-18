<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\SearchIPaymentMethodsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\CreateIPaymentMethodAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\DeleteIPaymentMethodAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\UpdateIPaymentMethodAction;
use Modules\Inventory\Http\Requests\PaymentMethods\CreateIPaymentMethodRequest;
use Modules\Inventory\Http\Requests\PaymentMethods\DeleteIPaymentMethodRequest;
use Modules\Inventory\Http\Requests\PaymentMethods\UpdateIPaymentMethodRequest;
use Modules\Inventory\Http\Resources\IPaymentMethodResource;
use Modules\Inventory\IPaymentMethod;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class IPaymentMethodsController extends Controller
{
    /**
     * Store i_payment_method
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateIPaymentMethodRequest $request, CreateIPaymentMethodAction $action)
    {
        // Create the i_payment_method
        $i_payment_method = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Payment method created successfully';
        $resp->status = true;
        $resp->data = $i_payment_method;
        return response()->json($resp, 200);
    }

    /**
     * Update i_payment_method
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIPaymentMethodRequest $request, UpdateIPaymentMethodAction $action)
    {
        // Update the i_payment_method
        $i_payment_method = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Payment method updated successfully';
        $resp->status = true;
        $resp->data = $i_payment_method;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_payment_method
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIPaymentMethodRequest $request, DeleteIPaymentMethodAction $action)
    {
        // Delete the i_payment_method
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Payment method deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_payment_methods
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_payment_methods
            $action = new SearchIPaymentMethodsQueryAction;
            $i_payment_methods = $action->execute($auth_user, $request);
            return Datatables::of($i_payment_methods)
                ->addColumn('value', function ($i_payment_method) {
                    return $i_payment_method->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('payment_method', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($i_payment_method) {
                    return $i_payment_method->created_at ? $i_payment_method->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_payment_method) {
                    return $i_payment_method->updated_at ?  $i_payment_method->updated_at->toDateTimeString() : null;
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

            return view('inventory::payment_methods.' . $blade_name);
        }
    }

    /**
     * Create i_payment_method
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::payment_methods.' . $blade_name, compact('languages'), []);
    }

    public function createIPaymentMethodModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('inventory::payment_methods.modals.create', compact('languages'), [])->render();
    }

    public function UpdateIPaymentMethodModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_payment_method = IPaymentMethod::find($id);

        // If i_payment_method does not exist, return error div
        if (!$i_payment_method) {
            $error = Lang::get('inventory::inventory.i_payment_method_not_found_or_you_are_not_authorized_to_edit_the_i_payment_method');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('inventory::payment_methods.modals.update', compact('i_payment_method', 'languages'), [])->render();
    }
}
