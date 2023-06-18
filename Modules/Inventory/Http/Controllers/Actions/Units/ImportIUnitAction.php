<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use App\Language;
use App\Media;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;
use Modules\Inventory\Http\Imports\ImportIUnits;
use stdClass;
use Excel;

class ImportIUnitAction
{
    public function execute($file)
    {
        return Excel::import(new ImportIUnits(), $file);
    }
}
