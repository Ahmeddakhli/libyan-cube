<?php

namespace Modules\About\Http\Controllers\Actions;

use Modules\About\About;

class DeleteAboutAction
{
    public function execute($id)
    {
        $about = About::find($id)->delete();
        return $about;
    }
}
