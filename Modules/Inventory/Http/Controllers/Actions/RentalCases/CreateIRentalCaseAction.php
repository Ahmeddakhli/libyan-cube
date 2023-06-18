<?php

namespace Modules\Inventory\Http\Controllers\Actions\RentalCases;

use Modules\Inventory\IRentalCase;
use Modules\Inventory\Http\Resources\IRentalCaseResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Lang;
use Carbon\Carbon;

class CreateIRentalCaseAction
{
    public function execute(array $data): IRentalCaseResource
    {
        // Transform from date
        if (isset($data['from'])) {
            // Create from date in user timezone then convert to UTC
            $from = Carbon::createFromFormat('Y-m-d H:i', $data['from'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->toDateTimeString();
            $data['from'] = $from;
        }
        // Transform to date
        if (isset($data['to'])) {
            // Create to date in user timezone then convert to UTC
            $to = Carbon::createFromFormat('Y-m-d H:i', $data['to'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->setTimezone('UTC')->toDateTimeString();
            $data['to'] = $to;
        }

        // Create the i_rental_case
        $i_rental_case = new IRentalCase($data);
        $i_rental_case->save();

        // Transform the result
        $i_rental_case = new IRentalCaseResource($i_rental_case);

        // Return the response
        return $i_rental_case;
    }
}
