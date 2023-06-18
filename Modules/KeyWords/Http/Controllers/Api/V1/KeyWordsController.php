<?php

namespace Modules\KeyWords\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\KeyWords\Http\Controllers\Actions\CreateKeyWordAction;
use Modules\KeyWords\Http\Controllers\Actions\DeleteKeyWordAction;
use Modules\KeyWords\Http\Controllers\Actions\UpdateKeyWordAction;
use Modules\KeyWords\Http\Requests\CreateKeyWordRequest;
use Modules\KeyWords\Http\Requests\DeleteKeyWordRequest;
use Modules\KeyWords\Http\Requests\UpdateKeyWordRequest;
use App\Http\Helpers\ServiceResponse;
use Modules\KeyWords\Http\Controllers\Actions\GetKeyWordsAction;

class KeyWordsController extends Controller
{
    /**
     * Store key word
     *
     * @param  [array] translations 
     * @param  [date] start_date
     * @param  [date] end_date
     * @param  [boolean] is_featured
     * @return [json] ServiceResponse object
     */
    public function store(CreateKeyWordRequest $request, CreateKeyWordAction $action)
    {
        // Create the key word
        $key_word = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key word created successfully';
        $resp->status = true;
        $resp->data = $key_word;

        return response()->json($resp, 200);
    }

    /**
     * Update key word
     *
     * @param  [integer] id
     * @param  [array] translations 
     * @param  [boolean] is_featured
     * @param  [date] start_date
     * @param  [date] end_date
     * @return [json] ServiceResponse object
     */
    public function update(UpdateKeyWordRequest $request, UpdateKeyWordAction $action)
    {
        // Update the key word
        $key_word = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key word updated successfully';
        $resp->status = true;
        $resp->data = $key_word;

        return response()->json($resp, 200);
    }

    /**
     * Delete key word
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteKeyWordRequest $request, DeleteKeyWordAction $action)
    {
        // Delete the key word
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key word deleted successfully';
        $resp->status = true;
        $resp->data = null;

        return response()->json($resp, 200);
    }

    /**
     * Index key words
     * @return Response
     */
    public function index(Request $request, GetKeyWordsAction $action)
    {
        // Get key words
        $key_words = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key words retrieved successfully';
        $resp->status = true;
        $resp->data = $key_words;

        return response()->json($resp, 200);
    }
}
