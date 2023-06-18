<?php

namespace Modules\Inventory\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\CreateIPaymentMethodAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\DeleteIPaymentMethodAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\UpdateIPaymentMethodAction;
use Modules\Inventory\Http\Requests\PaymentMethods\CreateIPaymentMethodRequest;
use Modules\Inventory\Http\Requests\PaymentMethods\DeleteIPaymentMethodRequest;
use Modules\Inventory\Http\Requests\PaymentMethods\GetIPaymentMethodsRequest;
use Modules\Inventory\Http\Requests\PaymentMethods\UpdateIPaymentMethodRequest;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;

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
     * Get i_payment_methods
     *
     * @return [json] ServiceResponse object
     */
    public function GetIPaymentMethods(GetIPaymentMethodsRequest $request, GetIPaymentMethodsAction $action)
    {
        // Get the i_payment_methods
        $i_payment_methods = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Payment methods retrieved successfully';
        $resp->status = true;
        $resp->data = $i_payment_methods;
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
}
