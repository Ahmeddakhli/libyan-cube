<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;

class IProjectsTagsInputAction
{
    public function execute(array $data)
    {
        $needle = $data['needle'];

        if ($needle) {
            $i_projects = IProject::whereHas('translations', function($translation) use ($needle) {
                $translation->where('project', 'like', '%'.$needle.'%');
            })->take(50)->get();
        } else {
            $i_projects = IProject::take(50)->get();
        }

        foreach ($i_projects as $i_project) {
            $i_project->name = $i_project->value ?? $i_project->default_value;
        }

        return $i_projects;
    }
}
