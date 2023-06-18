<?php

namespace Modules\Settings\Http\Controllers\Actions\HowWorks;

use Modules\Settings\HowWork;
use Modules\Settings\Http\Resources\HowWorks\HowWorkResource;
use Cache;
use App;

class GetHowWorksAction
{
    public function execute()
    {
        $how_works = HowWork::all();

        // Transform the how_works
        $how_works = HowWorkResource::collection($how_works);

        return $how_works;
    }
}
