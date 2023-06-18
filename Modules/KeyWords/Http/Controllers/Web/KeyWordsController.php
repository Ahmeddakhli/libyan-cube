<?php

namespace Modules\KeyWords\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\KeyWords\Http\Controllers\Actions\SearchKeyWordsQueryAction;
use Modules\KeyWords\Http\Controllers\Actions\CreateKeyWordAction;
use Modules\KeyWords\Http\Controllers\Actions\DeleteKeyWordAction;
use Modules\KeyWords\Http\Controllers\Actions\UpdateKeyWordAction;
use Modules\KeyWords\Http\Requests\CreateKeyWordRequest;
use Modules\KeyWords\Http\Requests\DeleteKeyWordRequest;
use Modules\KeyWords\Http\Requests\UpdateKeyWordRequest;
use Modules\KeyWords\KeyWord;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

class KeyWordsController extends Controller
{
    /**
     * Store key word
     *
     * @param  [array] translations 
     * @param  [boolean] is_featured
     * @return [json] ServiceResponse object
     */
    public function store(CreateKeyWordRequest $request, CreateKeyWordAction $action)
    {
        // Create the key word
        $key_words = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key word created successfully';
        $resp->status = true;
        $resp->data = ['redirect_to' => route('key_words.index'), 'key_word' => $key_words];

        return response()->json($resp, 200);
    }
    /**
     * Update key word
     *
     * @param  [integer] id
     * @param  [array] translations 
     * @param  [boolean] is_featured
     * @return [json] ServiceResponse object
     */
    public function update(UpdateKeyWordRequest $request, UpdateKeyWordAction $action)
    {
        // Update the key word
        $key_words = $action->execute($request->input('id'), $request->except(['id']));
        
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Key word updated successfully';
        $resp->status = true;
        $resp->data = $key_words;

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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the key words
            $action = new SearchKeyWordsQueryAction;
            $key_words = $action->execute($auth_user, $request);

            return Datatables::of($key_words)
                ->addColumn('value', function ($key_word) {
                    return $key_word->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($key_word) {
                    return $key_word->created_at ? $key_word->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($key_word) {
                    return $key_word->updated_at ? $key_word->updated_at->toDateTimeString() : null;
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

            return view('key_words::key_words.' . $blade_name);
        }
    }

    /**
     * Create key word
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        
        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('key_words::key_words.' . $blade_name, compact('languages'), []);
    }

    public function createKeyWordModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        
        // Get the languages
        $languages = Language::all();

        return view('key_words::key_words.modals.create', compact('languages'), [])->render();
    }

    public function UpdateKeyWordModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $key_word = KeyWord::where('id',$id)->with('types')->first();
        
        // If key word does not exist, return error div
        if (!$key_word) {
            $error = Lang::get('key_words::key_words.key_word_not_found_or_you_are_not_authorized_to_edit_the_key_word');
           
            return view('dashboard.components.error', compact('error'))->render();
        }
        // Get the languages
        $languages = Language::all();

        return view('key_words::key_words.modals.update', compact('key_word', 'languages'), [])->render();
    }
}
