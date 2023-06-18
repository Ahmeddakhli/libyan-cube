<?php

namespace Modules\Inventory\Http\Controllers\Actions\Search;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Inventory\IUnit;
use Modules\Inventory\Http\Controllers\Actions\Search\ProjectSearchAction;
use Modules\Inventory\Http\Controllers\Actions\Search\UnitSearchAction;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IProject;

class SearchAction
{
    public function execute($data)
    {
        $type = isset($data['type']) ? $data['type'] : null;
        switch ($type) {
            case 'unit':
                $action = new UnitSearchAction;
                $units = $action->execute($data);
                $units = $units->select('id', 'created_at')->selectSub('SELECT "Modules\\\Inventory\\\IUnit"', 'model');

                $data_paginated = $units->orderBy('created_at', 'desc')->paginate(6);
                break;
            case 'project':
                $action = new ProjectSearchAction;
                $projects = $action->execute($data);
                $projects = $projects->select('id', 'created_at')->selectSub('SELECT "Modules\\\Inventory\\\IProject"', 'model');

                $data_paginated = $projects->orderBy('created_at', 'desc')->paginate(6);
                break;
            default:
                // Get units
                $action = new UnitSearchAction;
                $units = $action->execute($data);
                $units = $units->select('id', 'created_at')->selectSub('SELECT "Modules\\\Inventory\\\IUnit"', 'model');

                // Get projects
                $action = new ProjectSearchAction;
                $projects = $action->execute($data);
                $projects = $projects->select('id', 'created_at')->selectSub('SELECT "Modules\\\Inventory\\\IProject"', 'model');

                // Merge units with projects
                $data_paginated = $units->union($projects)->orderBy('created_at', 'desc')->paginate(6);
                break;
        }

        // Transform the data
        $data_transformed = $data_paginated->map(function ($record) {
            $class = $record->model;
            switch ($class) {
                case get_class(new IUnit):
                    return ['class' => $class, 'object' =>  new IUnitResource(IUnit::find($record->id))];
                    break;
                case get_class(new IProject):
                    return ['class' => $class, 'object' =>  new IProjectResource(IProject::find($record->id))];
                    break;
                default:
                    return ['class' => $class, 'object' => $record];
                    break;
            }
        });

        // Paginate the transformed data
        $data_paginated_and_transformed = new LengthAwarePaginator(
            json_decode(json_encode($data_transformed)),
            $data_paginated->total(),
            $data_paginated->perPage(),
            $data_paginated->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $data_paginated->currentPage()
                ]
            ]
        );

        // Return  the response 
        return $data_paginated_and_transformed;
    }
}
