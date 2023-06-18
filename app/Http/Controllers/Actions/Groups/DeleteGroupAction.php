<?php

namespace App\Http\Controllers\Actions\Groups;

use App\Models\Group;
use Askedio\SoftCascade\Exceptions\SoftCascadeLogicException;

class DeleteGroupAction
{
	public function __construct()
	{
		//
	}

	public function execute($id)
	{
        // Delete the group
        $group = Group::find($id);

        try {
            $group->delete();
        } catch (SoftCascadeLogicException $e) {
            return false;
        }

        return true;
	}
}