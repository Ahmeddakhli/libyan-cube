<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Modules\Compares\Compare;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Compares\Http\Controllers\Actions\GetExportComparesAction;
use Auth;
use PDF;

class ComparesController extends Controller
{
    public function features()
    {
        return [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $features = $this->features();

        // Get compares
        $action = new GetComparesAction;
        $compares_all = json_decode(json_encode($action->execute()));

        // Split compares into compares and waiting to compare 
        $compares = array_slice($compares_all, 0, 3);
        $waiting_to_compare = array_slice($compares_all, 3);

        // Append to features array 
        $features['compares'] = $compares;
        $features['wating_to_compare'] = $waiting_to_compare;

        $compares_check = new Compare();

        // If authenticated user
        if (Auth::check()) {
            $compares_check->where('user_id', auth()->user()->id);
        } else {
            // Guest session
            $session = request()->session()->get('_token');
            $compares_check->where('session', $session);
        }

        // Get array of id`s for units in compare 
        $compares_check = $compares_check->pluck('unit_id')->toArray();

        // If Ajax request
        if ($request->ajax()) {
            return view('front.components.compare-ajax',[
                'compares' => $compares_all
            ])->render();
        }

        return view('front.pages.compares', $features);
    }

    public function export(Request $request)
    {
        // Get compares
        $action = new GetExportComparesAction;
        $data = json_decode(json_encode($action->execute()));

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('front.components.compare_pdf', [
            'data' => $data
        ],[],[
            'format' => 'A4-L',
            'orientation' => 'L'  
        ]);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');


        // Finally, you can download the file using download function
        return $pdf->download (env('APP_NAME').'-COMPARE.pdf');
    }

    public function changeOrder(Request $request)
    {
        $first_compare = Compare::where('id', $request->first_compare_id)->first();
        $last_compare = Compare::where('id', $request->last_compare_id)->first();

        $first_current_order = $first_compare->order;
        $last_current_order = $last_compare->order;

        // Change order 
        $first_compare->update([
            'order' => $last_current_order
        ]);
        $last_compare->update([
            'order' => $first_current_order
        ]);

        // Get compares
        $action = new GetComparesAction;
        $compares_all = json_decode(json_encode($action->execute()));
        $compares = array_slice($compares_all, 0, 3);
        $wating_to_compare = array_slice($compares_all, 3);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Order changed';
        $resp->status = true;
        $resp->data = [
            'compares' => view('front.partials.compares.compare', compact('compares'))->render(),
            'compare_waiting' => view('front.partials.compares.compare-wait', compact('wating_to_compare'))->render()
        ];
        
        return response()->json($resp, 200);
    }

    public function reload()
    {
        // Get compares
        $action = new GetComparesAction;
        $compares_all = json_decode(json_encode($action->execute()));
        $compares = array_slice($compares_all, 0, 3);
        $wating_to_compare = array_slice($compares_all, 3);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Reloaded';
        $resp->status = true;
        $resp->data = [
            'compares' => view('front.partials.compares.compare', compact('compares'))->render(),
            'compare_waiting' => view('front.partials.compares.compare-wait', compact('wating_to_compare'))->render()
        ];

        return response()->json($resp, 200);
    }
}
