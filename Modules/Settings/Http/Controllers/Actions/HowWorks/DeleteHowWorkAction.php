<?php

namespace Modules\Settings\Http\Controllers\Actions\HowWorks;

use Modules\Settings\HowWork;

class DeleteHowWorkAction
{
    public function execute($id)
    {
        // Delete how work
        HowWork::find($id)->delete();

        // Return response
        return null;
    }
}
