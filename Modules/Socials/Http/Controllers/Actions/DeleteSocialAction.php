<?php

namespace Modules\Socials\Http\Controllers\Actions;

use Modules\Socials\Social;

class DeleteSocialAction
{
    public function execute($id)
    {
        // Delete socials
        $social = Social::find($id)->delete();

        // return response
        return null;
    }
}
