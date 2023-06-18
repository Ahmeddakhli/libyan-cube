<?php

namespace Modules\Inventory\Http\Controllers\Actions\Developers;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\Http\Resources\FrontDeveloperResource;
use Modules\Inventory\Http\Resources\IDeveloperResource;
use Modules\Inventory\IDeveloper;

class GetIDevelopersFrontAction
{
    public function execute($data)
    {
        // Get i_developer
        $i_developers = new IDeveloper();

        // Search developers 
        if (isset($data['location']) && !is_null($data['location'])) {
            $i_developers = $i_developers->where('country_id', $data['location'])
                ->orwhere('region_id', $data['location'])
                ->orwhere('city_id', $data['location'])
                ->orwhere('area_id', $data['location']);
        }
        if (isset($data['developer']) && !is_null($data['developer'])) {
            $i_developers = $i_developers->whereIn('id', $data['developer']);
        }
        if (isset($data['keyword']) && !is_null($data['keyword'])) {
            $i_developers = $i_developers->whereHas('translations', function ($translations) use ($data) {
                $translations->where('developer','like' ,'%'.$data['keyword'].'%');
            });
        }
        $i_developers = $i_developers->orderBy('created_at', 'DESC');
        $i_developers = $i_developers->paginate(12);
        $i_developers =  IDeveloperResource::collection($i_developers);

        $i_developers = new LengthAwarePaginator(
            json_decode(json_encode($i_developers)),
            $i_developers->total(),
            $i_developers->perPage(),
            $i_developers->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $i_developers->currentPage()
                ]
            ]
        );
        return $i_developers;
    }
}
