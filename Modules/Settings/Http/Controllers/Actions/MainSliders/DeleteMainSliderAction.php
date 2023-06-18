<?php

namespace Modules\Settings\Http\Controllers\Actions\MainSliders;

use Modules\Settings\MainSlider;

class DeleteMainSliderAction
{
    public function execute($id)
    {
        // Delete main slider
        MainSlider::find($id)->delete();

        // Return response
        return null;
    }
}
