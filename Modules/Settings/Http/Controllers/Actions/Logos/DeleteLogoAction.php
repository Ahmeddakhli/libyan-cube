<?php

namespace Modules\Settings\Http\Controllers\Actions\Logos;

use Modules\Settings\Logo;

class DeleteLogoAction
{
    public function execute($id)
    {
        //  Delete logo 
        Logo::find($id)->delete();

        // Return response
        return null;
    }
}
