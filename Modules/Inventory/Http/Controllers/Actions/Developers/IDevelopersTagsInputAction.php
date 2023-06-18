<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Modules\Inventory\IDeveloper;

class IDevelopersTagsInputAction
{
    public function execute(array $data)
    {
        $needle = $data['needle'];

        if ($needle) {
            $i_developers = IDeveloper::whereHas('translations', function($translation) use ($needle) {
                $translation->where('developer', 'like', '%'.$needle.'%');
            })->take(50)->get();
        } else {
            $i_developers = IUnit::take(50)->get();
        }

        foreach ($i_developers as $developer) {
            $developer->name = $developer->value ? $developer->value : $developer->default_value;
        }

        return $i_developers;
    }
}
